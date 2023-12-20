<?php

namespace App\Livewire\Order\Index;

use Livewire\Attributes\Lazy;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Store;
use App\Models\Order;

class Page extends Component
{
    public Store $store;

    public function render()
    {
        return view('livewire.order.index.page');
    }
}
