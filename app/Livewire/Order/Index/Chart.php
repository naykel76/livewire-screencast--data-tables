<?php

namespace App\Livewire\Order\Index;

use Livewire\Attributes\Reactive;
use Livewire\Component;
use App\Models\Store;
use App\Models\Order;

class Chart extends Component
{
    #[Reactive]
    public Store $store;

    #[Reactive]
    public $filters;

    public function getChartData()
    {
        $queryWithDayOrHourIncrements = $this->filters->range === Range::Today
            ? $this->store->orders()->select(
                \Illuminate\Support\Facades\DB::raw('HOUR(ordered_at) as time_increment'),
                \Illuminate\Support\Facades\DB::raw('SUM(amount) as total')
            )
            : $this->store->orders()->select(
                \Illuminate\Support\Facades\DB::raw('DATE(ordered_at) as time_increment'),
                \Illuminate\Support\Facades\DB::raw('SUM(amount) as total')
            );

        $result = $queryWithDayOrHourIncrements
            ->tap($this->filters->apply(...))
            ->groupBy('time_increment')
            ->get()
            ->mapWithKeys(function ($i) {
                $label = $i->time_increment;
                $value = (int) $i->total;

                return [$label => $value];
            })
            ->toArray();

        return [
            'labels' => array_keys($result),
            'values' => array_values($result),
        ];
    }

    public function render()
    {
        $this->dispatch('update-chart', data: $this->getChartData())->self();

        return view('livewire.order.index.chart');
    }

    public function placeholder()
    {
        return view('livewire.order.index.chart-placeholder');
    }
}
