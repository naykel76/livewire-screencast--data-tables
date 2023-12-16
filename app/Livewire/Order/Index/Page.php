<?php

namespace App\Livewire\Order\Index;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Store;

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
}
