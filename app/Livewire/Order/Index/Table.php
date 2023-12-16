<?php

namespace App\Livewire\Order\Index;

use Livewire\WithPagination;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Reactive;
use App\Models\Store;
use App\Models\Order;

class Table extends Component
{
    use WithPagination, Sortable;

    #[Reactive]
    public Store $store;

    #[Reactive]
    public Filters $filters;

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

    #[Renderless]
    public function export()
    {
        return response()->streamDownload(function () {
            $query = $this->filters->apply(Order::query());

            echo $this->toCsv($query);
        }, 'transactions.csv');
    }

    public function archive()
    {
        sleep(1);
        // @todo: add a status change to "archived"
        $orders = $this->store->orders()->whereIn('id', $this->selectedOrderIds)->get();

        foreach ($orders as $order) {
            $this->archive($order);
        }
    }

    public function archiveOrder(Order $order)
    {
        $this->authorize('update', $order);

        $order->archive();
    }

    public function refund()
    {
        $orders = Order::whereIn('id', $this->selectedOrderIds)->get();

        foreach ($orders as $order) {
            $this->refundOrder($order);
        }
    }

    public function refundOrder(Order $order)
    {
        $this->authorize('update', $order);

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
        return view('livewire.order.index.table-placeholder');
    }

    public function render()
    {
        // Handle search...
        $query = $this->search
            ? $this->store->orders()->where('email', 'like', '%'.$this->search.'%')
            : $this->store->orders();

        // Handle products, date range, and status...
        $this->filters->apply($query);

        // Handle sorting...
        $this->applySorting($query);

        // Handle pagination...
        // @todo: reset pagination when search changes...
        $orders = $query->paginate(10);

        $this->orderIdsOnPage = $orders->map(fn ($i) => (string) $i->id)->toArray();

        return view('livewire.order.index.table', [
            'orders' => $orders,
        ]);
    }
}
