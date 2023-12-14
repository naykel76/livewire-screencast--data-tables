<?php

namespace App\Livewire\Pages\Order;

use Livewire\WithPagination;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Reactive;
use App\Models\Store;
use App\Models\Order;

class Table extends Component
{
    use WithPagination;
    use HasOrderFilters;

    #[Reactive]
    public Store $store;

    #[Reactive]
    public $range;

    #[Reactive]
    public $rangeStart;

    #[Reactive]
    public $rangeEnd;

    #[Reactive]
    public $status;

    #[Reactive]
    public $selectedProductIds = [];

    #[Url]
    public $sortCol;

    #[Url]
    public $sortAsc;

    public $search = '';

    public $selectedOrderIds = [];

    public $orderIdsOnPage = [];

    public function updated($fullPath)
    {
        $this->resetPage();

        if (str($fullPath)->before('.')->toString() !== 'selectedOrderIds') {
            $this->selectedOrderIds = [];
        }
    }

    public function sortBy($col)
    {
        if ($this->sortCol === $col) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortCol = $col;
            $this->sortAsc = true;
        }
    }

    protected function applySorting($query)
    {
        if ($this->sortCol) {
            $column = match ($this->sortCol) {
                'number' => 'number',
                'date' => 'ordered_at',
                'status' => 'status',
                'amount' => 'amount',
            };

            $query->orderBy($column, $this->sortAsc ? 'asc' : 'desc');
        }

        return $query;
    }

    #[Renderless]
    public function export()
    {
        return response()->streamDownload(function () {
            $query = $this->filterByProduct($this->filterByRange($this->filterByStatus(Order::query())));

            echo $this->toCsv($query);
        }, 'transactions.csv');
    }

    public function archive()
    {
        sleep(1);
        // @todo: add auth...
        // @todo: add a status change to "archived"
        $orders = Order::whereIn('id', $this->selectedOrderIds)->get();

        foreach ($orders as $order) {
            $order->archive();
        }
    }

    public function archiveOrder(Order $order)
    {
        $order->archive();
    }

    public function refund()
    {
        // @todo: add auth...
        $orders = Order::whereIn('id', $this->selectedOrderIds)->get();

        foreach ($orders as $order) {
            $order->refund();
        }
    }

    public function refundOrder(Order $order)
    {
        $order->refund();
    }

    protected function toCsv($query)
    {
        $results = $query->get();

        if ($results->count() < 1) return;

        $titles = implode(',', array_keys((array) $results->first()->getAttributes()));

        $values = $results->map(function ($result) {
            return implode(',', collect($result->getAttributes())->map(function ($thing) {
                return '"'.$thing.'"';
            })->toArray());
        });

        $values->prepend($titles);

        return $values->implode("\n");
    }

    public function placeholder()
    {
        return view('livewire.pages.order.table-placeholder');
    }

    public function render()
    {
        // Handle search...
        $query = $this->search
            ? Order::where('email', 'like', '%'.$this->search.'%')
            : Order::query();

        // Handle product filtering...
        $this->filterByProduct($query);

        // Handle date range filtering...
        $this->filterByRange($query);

        // Handle status filtering...
        $this->filterByStatus($query);

        // Handle sorting...
        $this->applySorting($query);

        // Handle pagination...
        // @todo: reset pagination when search changes...
        $orders = $query->paginate(10);

        $this->orderIdsOnPage = $orders->map(fn ($i) => (string) $i->id)->toArray();

        return view('livewire.pages.order.table', [
            'orders' => $orders,
        ]);
    }
}
