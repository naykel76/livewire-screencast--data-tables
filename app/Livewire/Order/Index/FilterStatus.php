<?php

namespace App\Livewire\Order\Index;

use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use App\Models\Store;

class FilterStatus extends Component
{
    #[Reactive]
    public Store $store;

    #[Modelable]
    public Filters $filters;

    protected function statuses()
    {
        return collect($this->filters->status::cases())->map(function ($status) {
            return [
                'current' => $status === $this->filters->status,
                'label' => $status->label(),
                'value' => $status->value,
                'count' => $this->filters->apply($this->store->orders(), $status)->count(),
            ];
        });
    }

    protected function placeholderStatuses()
    {
        return collect($this->filters->status::cases())->map(function ($status) {
            return [
                'current' => $status === $this->filters->status,
                'label' => $status->label(),
                'value' => $status->value,
                'count' => '...',
            ];
        });
    }

    public function render()
    {
        return view('livewire.order.index.filter-status', [
            'statuses' => $this->statuses(),
        ]);
    }

    public function placeholder()
    {
        return view('livewire.order.index.filter-status-placeholder', [
            'statuses' => $this->placeholderStatuses(),
        ]);
    }
}
