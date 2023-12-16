<?php

namespace App\Livewire\Order\Index;

use Livewire\Features\SupportFormObjects\Form;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Url;
use Illuminate\Support\Carbon;
use App\Models\Store;

class Filters extends Form
{
    public Store $store;

    // @todo: when range=null is set in the query string by hand it won't be removed...
    // This is annoying because refreshing the page then chaning back to "all-time" causes this...
    // And the url is cleaned up. Would be nice to have an option "force" cleanliness...
    // Like Jess and Tim noticed...
    #[Url]
    public Status $status = Status::All;

    // @todo: it would be nice to have cleaner array representation in the query string...
    #[Url(as: 'products')]
    public $selectedProductIds = [];

    #[Url]
    public Range $range = Range::All_Time;

    #[Url, Validate('required', message: 'You are missing the start date.')]
    public $start;

    #[Url, Validate('required', message: 'You are missing the end date.')]
    public $end;

    public $showRangeDropdown = false;

    public function initialize($store)
    {
        $this->store = $store;

        // Only set the product IDs if there isn't any in the query string...
        if (request()->query('products', false) === false) {
            $this->selectedProductIds = $store->products->map(fn ($i) => (string) $i->id)->toArray();
        }
    }

    public function setCustomRange()
    {
        $this->range = Range::Custom;

        $this->showRangeDropdown = false;
    }

    public function getProducts()
    {
        return $this->store->products;
    }

    public function apply($query, $status = null) {
        $query = $this->applyStatus($query, $status);
        $query = $this->applyProduct($query);
        $query = $this->applyRange($query);

        return $query;
    }

    protected function applyProduct($query) {
        return $query->whereIn('product_id', $this->selectedProductIds);
    }

    protected function applyStatus($query, $status = null)
    {
        $status = $status ?: $this->status;

        return match ($status) {
            Status::Paid => $query->where('status', 'paid'),
            Status::Refunded => $query->where('status', 'refunded'),
            Status::Failed => $query->where('status', 'failed'),
            default => $query,
        };
    }

    protected function applyRange($query)
    {
        if ($this->range === Range::All_Time) {
            return $query;
        }

        $dateRange = $this->range->dates(
            $this->start,
            $this->end,
        );

        return $query->whereBetween('ordered_at', $dateRange);
    }
}
