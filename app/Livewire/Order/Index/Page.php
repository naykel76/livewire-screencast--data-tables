<?php

namespace App\Livewire\Order\Index;

use Livewire\Component;
use App\Models\Store;

class Page extends Component
{
    public Store $store;

    public function render()
    {
        return view('livewire.order.index.page', [
            'orders' => $this->store->orders()->take(10)->get(),
        ]);
    }
}
