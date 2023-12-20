<?php

namespace App\Livewire\Order\Index;

use Livewire\Attributes\Lazy;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Store;
use App\Models\Order;

#[Lazy]
class Page extends Component
{
    use WithPagination, Sortable, Searchable;

    public Store $store;

    public $selectedOrderIds = [];

    public $orderIdsOnPage = [];

    public function export()
    {
        return $this->store->orders()->toCsv();
    }

    public function refundSelected()
    {
        $orders = $this->store->orders()->whereIn('id', $this->selectedOrderIds)->get();

        foreach ($orders as $order) {
            $this->refund($order);
        }
    }

    public function refund(Order $order)
    {
        $this->authorize('update', $order);

        $order->refund();
    }

    public function archiveSelected()
    {
        $orders = $this->store->orders()->whereIn('id', $this->selectedOrderIds)->get();

        foreach ($orders as $order) {
            $this->archive($order);
        }
    }

    public function archive(Order $order)
    {
        $this->authorize('update', $order);

        $order->archive();
    }

    public function render()
    {
        $query = $this->store->orders();

        $query = $this->applySearch($query);

        $query = $this->applySorting($query);

        $orders = $query->paginate(5);

        $this->orderIdsOnPage = $orders->map(fn ($order) => (string) $order->id)->toArray();

        return view('livewire.order.index.page', [
            'orders' => $orders,
        ]);
    }

    public function placeholder()
    {
        return view('livewire.order.index.table-placeholder');
    }
}
