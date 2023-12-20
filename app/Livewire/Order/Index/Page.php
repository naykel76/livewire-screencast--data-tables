<?php

namespace App\Livewire\Order\Index;

use Livewire\WithPagination;
use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\Store;
use App\Models\Order;
use Livewire\Attributes\Renderless;

class Page extends Component
{
    use WithPagination;

    public Store $store;

    public $search = '';

    #[Url]
    public $sortCol;

    #[Url]
    public $sortAsc = false;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[Renderless]
    public function export()
    {
        return $this->store->orders()->toCsv();
    }

    public function refund(Order $order)
    {
        $this->authorize('update', $order);

        $order->refund();
    }

    public function archive(Order $order)
    {
        $this->authorize('update', $order);

        $order->archive();
    }

    public function sortBy($column)
    {
        if ($this->sortCol === $column) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortCol = $column;
            $this->sortAsc = false;
        }
    }

    protected function applySorting($query)
    {
        if ($this->sortCol) {
            $column = match ($this->sortCol) {
                'number' => 'number',
                'status' => 'status',
                'date' => 'ordered_at',
                'amount' => 'amount',
            };

            $query->orderBy($column, $this->sortAsc ? 'asc' : 'desc');
        }

        return $query;
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

        $query = $this->applySorting($query);

        return view('livewire.order.index.page', [
            'orders' => $query->paginate(10),
        ]);
    }
}
