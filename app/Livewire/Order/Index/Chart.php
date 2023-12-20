<?php

namespace App\Livewire\Order\Index;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Store;

class Chart extends Component
{
    public Store $store;

    public $dataset = [];

    public function mount()
    {
        $this->fillDataset();
    }

    public function fillDataset()
    {
        $results = $this->store->orders()
            ->select(
                DB::raw("strftime('%Y', ordered_at) || '-' || strftime('%m', ordered_at) as increment"),
                DB::raw('SUM(amount) as total'),
            )
            ->groupBy('increment')
            ->get();

        $this->dataset['values'] = $results->pluck('total')->toArray();
        $this->dataset['labels'] = $results->pluck('increment')->toArray();
    }

    public function render()
    {
        return view('livewire.order.index.chart');
    }
}
