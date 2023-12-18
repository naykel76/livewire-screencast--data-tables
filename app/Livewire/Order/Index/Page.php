<?php

namespace App\Livewire\Order\Index;

use Livewire\Component;
use App\Models\Store;
use Livewire\WithPagination;

class Page extends Component
{
    use WithPagination;

    public Store $store;

    public function render()
    {
        return view('livewire.order.index.page', [
            'orders' => $this->store->orders()->paginate(10),
        ]);
    }
}
