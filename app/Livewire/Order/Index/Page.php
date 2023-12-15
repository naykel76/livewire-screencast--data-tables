<?php

namespace App\Livewire\Order\Index;

use Livewire\Attributes\{ Validate, Url, Title, Lazy };
use App\Models\{ Store, Order };
use Illuminate\Support\Carbon;
use Livewire\Component;

#[Title('Show orders')]
class Page extends Component
{
    public Store $store;

    public Filters $filters;

    public function mount()
    {
        $this->filters->initialize($this->store);
    }

    public function setCustomRange()
    {
        $this->filters->setCustomRange();
    }

    public function render()
    {
        return view('livewire.order.index.page', [
            'products' => $this->store->products,
        ]);
    }
}
