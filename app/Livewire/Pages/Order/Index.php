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
    public Store $store;

    public Filters $filters;

    public $showRangeDropdown = false;

    public function mount()
    {
        $this->filters->initializeSelectedProducts($this->store);
    }

    public function setCustomRange()
    {
        $this->validate();

        $this->filters->range = 'custom';

        $this->showRangeDropdown = false;
    }

    public function render()
    {
        return view('livewire.pages.order.index', [
            'products' => $this->store->products,
        ]);
    }
}
