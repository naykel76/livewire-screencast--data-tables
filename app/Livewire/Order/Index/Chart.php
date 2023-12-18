<?php

namespace App\Livewire\Order\Index;

use Livewire\Attributes\Reactive;
use Livewire\Component;
use App\Models\Store;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class Chart extends Component
{
    #[Reactive]
    public Store $store;

    #[Reactive]
    public $filters;

    public function getChartData()
    {
        $result = $this->store->orders()
            ->tap(function ($query) {
                return match ($this->filters->range) {
                    // These are for Sqlite. If using MySQL, use "HOUR()" and "MONTH()"...
                    Range::Today => $query->select(DB::raw("strftime('%H', ordered_at) as time_increment"), DB::raw('SUM(amount) as total')),
                    Range::All_Time => $query->select(DB::raw("strftime('%Y', ordered_at) || '-' || strftime('%m', ordered_at) as time_increment"), DB::raw('SUM(amount) as total')),
                    Range::Year => $query->select(DB::raw("strftime('%Y', ordered_at) || '-' || strftime('%m', ordered_at) as time_increment"), DB::raw('SUM(amount) as total')),
                    default => $query->select(DB::raw('DATE(ordered_at) as time_increment'), DB::raw('SUM(amount) as total')),
                };
            })
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
