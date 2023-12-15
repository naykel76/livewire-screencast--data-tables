<?php

namespace App\Livewire\Order\Index;

use Livewire\Component;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Modelable;
use App\Models\Store;
use App\Models\Order;

class FilterStatus extends Component
{
    #[Reactive]
    public Store $store;

    #[Modelable]
    public Filters $filters;

    public function render()
    {
        return view('livewire.order.index.filter-status', [
            'counts' => [
                'all' => $this->filters->filterQuery(Order::query(), status: 'all')->count(),
                'paid' => $this->filters->filterQuery(Order::query(), status: 'paid')->count(),
                'failed' => $this->filters->filterQuery(Order::query(), status: 'failed')->count(),
                'refunded' => $this->filters->filterQuery(Order::query(), status: 'refunded')->count(),
            ],
        ]);
    }

    public function placeholder()
    {
        return view('livewire.order.index.filter-status-placeholder', [
            'filters' => $this->filters,
            'counts' => [
                'all' => '...',
                'paid' => '...',
                'failed' => '...',
                'refunded' => '...',
            ]
        ]);
    }
}
