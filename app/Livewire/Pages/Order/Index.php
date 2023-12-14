<?php

namespace App\Livewire\Pages\Order;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Url;
use Livewire\Attributes\Title;
use Livewire\Attributes\Lazy;
use Illuminate\Support\Carbon;
use App\Models\Store;
use App\Models\Order;

#[Title('Orders')]
// @todo: naming this "Index" makes it hard to use Cmd+p and search "orders" to find it...
class Index extends Component
{
    use HasOrderFilters;

    public Store $store;

    // @todo: when range=null is set in the query string by hand it won't be removed...
    // This is annoying because refreshing the page then chaning back to "all-time" causes this...
    // And the url is cleaned up. Would be nice to have an option "force" cleanliness...
    // Like Jess and Tim noticed...
    #[Url]
    public $range = null;

    #[Url]
    #[Validate('required', message: 'You are missing the start date.')]
    public $rangeStart;

    #[Url]
    #[Validate('required', message: 'You are missing the end date.')]
    public $rangeEnd;

    #[Url]
    public $status = 'paid';

    // @todo: it would be nice to have cleaner array representation in the query string...
    #[Url]
    public $selectedProductIds = [];

    public $showRangeDropdown = false;

    public function mount()
    {
        // @todo: because we're setting these values in mount, it overrides the #[Url] binding...
        if (count($this->selectedProductIds) === 0) {
            $this->selectedProductIds = $this->store->products->map(fn($i) => (string) $i->id)->toArray();
        }
    }

    public function setCustomRange()
    {
        $this->validate();

        $this->range = 'custom';

        $this->showRangeDropdown = false;
    }

    public function render()
    {
        return view('livewire.pages.order.index', [
            'products' => $this->store->products,
        ]);
    }
}
