<?php

namespace App\Livewire\Pages\Order;

use Livewire\Component;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Modelable;
use App\Models\Store;
use App\Models\Order;

class FilterStatus extends Component
{
    use HasOrderFilters;

    #[Reactive]
    public Store $store;

    #[Reactive]
    public $range;

    #[Reactive]
    public $rangeStart;

    #[Reactive]
    public $rangeEnd;

    #[Modelable]
    public $status;

    #[Reactive]
    public $selectedProductIds = [];

    public function render()
    {
        return view('livewire.pages.order.filter-status', [
            'counts' => [
                'all' => $this->filterByRange(Order::whereIn('product_id', $this->selectedProductIds))->count(),
                'paid' => $this->filterByProduct($this->filterByRange($this->filterByStatus(Order::query(), 'paid')))->count(),
                'failed' => $this->filterByProduct($this->filterByRange($this->filterByStatus(Order::query(), 'failed')))->count(),
                'refunded' => $this->filterByProduct($this->filterByRange($this->filterByStatus(Order::query(), 'refunded')))->count(),
            ],
        ]);
    }

    public function placeholder()
    {
        return view('livewire.pages.order.filter-status-placeholder', [
            'status' => $this->status,
            'counts' => [
                'all' => '...',
                'paid' => '...',
                'failed' => '...',
                'refunded' => '...',
            ]
        ]);
    }
}
