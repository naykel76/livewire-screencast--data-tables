<?php

namespace App\Livewire\Order\Index;

use Livewire\Component;
use App\Models\Store;
use Livewire\WithPagination;

class Page extends Component
{
    use WithPagination;

    public Store $store;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    protected function applySearch($query)
    {
        return $this->search === ''
            ? $query
            : $query
                ->where('email', 'like', '%'.$this->search.'%')
                ->orWhere('number', 'like', '%'.$this->search.'%');
    }

    public function render()
    {
        $query = $this->store->orders();

        $query = $this->applySearch($query);

        return view('livewire.order.index.page', [
            'orders' => $query->paginate(10),
        ]);
    }
}
