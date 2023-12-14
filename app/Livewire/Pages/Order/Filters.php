<?php

namespace App\Livewire\Pages\Order;

use Livewire\Features\SupportFormObjects\Form;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Url;
use Illuminate\Support\Carbon;

class Filters extends Form
{
    // @todo: when range=null is set in the query string by hand it won't be removed...
    // This is annoying because refreshing the page then chaning back to "all-time" causes this...
    // And the url is cleaned up. Would be nice to have an option "force" cleanliness...
    // Like Jess and Tim noticed...
    #[Url]
    public $range = null;

    #[Url]
    public $status = 'all';

    #[Url(as: 'start')]
    #[Validate('required', message: 'You are missing the start date.')]
    public $rangeStart;

    #[Url(as: 'end')]
    #[Validate('required', message: 'You are missing the end date.')]
    public $rangeEnd;

    // @todo: it would be nice to have cleaner array representation in the query string...
    #[Url(as: 'products')]
    public $selectedProductIds = [];

    public function initializeSelectedProducts($store)
    {
        // Only set the product IDs if there isn't any in the query string...
        if (request()->query('products', false) === false) {
            $this->selectedProductIds = $store->products->map(fn($i) => (string) $i->id)->toArray();
        }
    }

    public function filterQuery($query, $status = null) {
        return $this->filterByRange(
            $this->filterByProduct(
                $this->filterByStatus(
                    $query, $status
                )
            )
        );
    }

    public function filterByRange($query)
    {
        switch ($this->range) {
            case 'today':
                $query->whereDate('ordered_at', Carbon::today());
                break;

            case 'last7':
                $query->whereBetween('ordered_at', [Carbon::today()->subDays(6), Carbon::now()]);
                break;

            case 'last30':
                $query->whereBetween('ordered_at', [Carbon::today()->subDays(29), Carbon::now()]);
                break;

            case 'year':
                $query->whereBetween('ordered_at', [Carbon::now()->startOfYear(), Carbon::now()]);
                break;

            case 'custom':
                $start = Carbon::createFromFormat('Y-m-d', $this->rangeStart);
                $end = Carbon::createFromFormat('Y-m-d', $this->rangeEnd);
                $query->whereBetween('ordered_at', [$start, $end]);
                break;

            default:
                # code...
                break;
        }

        return $query;
    }

    public function filterByProduct($query) {
        $query->whereIn('product_id', $this->selectedProductIds);

        return $query;
    }

    public function filterByStatus($query, $status = null)
    {
        $status = $status ?: $this->status;

        switch ($status) {
            case 'paid':
                $query->where('status', 'paid');
                break;

            case 'refunded':
                $query->where('status', 'refunded');
                break;

            case 'failed':
                $query->where('status', 'failed');
                break;

            case 'all':
                //
                break;

            default:
                # code...
                break;
        }

        return $query;
    }
}
