<?php

namespace App\Livewire\Pages\Order;

use Livewire\Component;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Carbon;
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
        if ($this->filters->range === 'today') {
            $result = Order::select(
                \Illuminate\Support\Facades\DB::raw('HOUR(ordered_at) as hour'),
                \Illuminate\Support\Facades\DB::raw('SUM(amount) as hourly_total')
            )
            ->whereBetween('ordered_at', [Carbon::today()->subDays(1), Carbon::now()])
            ->tap(function ($query) {
                $this->filters->filterByStatus($query);
                $this->filters->filterByProduct($query);
            })
            ->groupBy('hour')
            ->get()
            ->mapWithKeys(function ($i) {
                $label = $i->hour;
                $value = (int) $i->hourly_total;

                return [$label => $value];
            })
            ->toArray();
        } else {
            $result = Order::select(
                \Illuminate\Support\Facades\DB::raw('DATE(ordered_at) as date'),
                \Illuminate\Support\Facades\DB::raw('SUM(amount) as daily_total')
            )
            ->tap(function ($query) {
                $this->filters->filterByStatus($query);
                $this->filters->filterByProduct($query);
            })
            ->where(function ($query) {
                return match ($this->filters->range) {
                    null => $query,
                    'year' => $query->whereBetween('ordered_at', [Carbon::now()->startOfYear(), Carbon::now()]),
                    'last30' => $query->whereBetween('ordered_at', [Carbon::today()->subDays(29), Carbon::now()]),
                    'last7' => $query->whereBetween('ordered_at', [Carbon::today()->subDays(6), Carbon::now()]),
                    'custom' => $query->whereBetween('ordered_at', [Carbon::createFromFormat('Y-m-d', $this->filters->rangeStart), Carbon::createFromFormat('Y-m-d', $this->filters->rangeEnd)]),
                };
            })
            ->groupBy('date')
            ->get()
            ->mapWithKeys(function ($i) {
                $label = $i->date;
                $value = (int) $i->daily_total;

                return [$label => $value];
            })
            ->toArray();
        }

        $labels = array_keys($result);
        $values = array_values($result);

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }

    public function render()
    {
        // @todo: find a better way...
        // @todo: make scripts run before dispatches (because /supportEvents is use in imports earlier on...)
        $this->dispatch('update-chart', data: $this->getChartData())->self();

        return view('livewire.pages.order.chart');
    }

    public function placeholder()
    {
        return view('livewire.pages.order.chart-placeholder');
    }
}
