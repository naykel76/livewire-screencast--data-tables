<?php

namespace App\Livewire\Pages\Order;

use Livewire\WithPagination;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Title;
use Illuminate\Support\Carbon;
use App\Models\Store;
use App\Models\Order;
use Livewire\Attributes\Validate;

#[Title('Orders')]
// @todo: naming this "Index" makes it hard to use Cmd+p and search "orders" to find it...
class Index extends Component
{
    use WithPagination;

    public Store $store;

    public $search = '';

    // @todo: when range=null is set in the query string by hand it won't be removed...
    // This is annoying because refreshing the page then chaning back to "all-time" causes this...
    // And the url is cleaned up. Would be nice to have an option "force" cleanliness...
    // Like Jess and Tim noticed...
    #[Url]
    public $range = null;

    #[Url]
    #[Validate('required', message: 'You are missing the start date.')]
    public $rangeStart;

    #[Url]
    #[Validate('required', message: 'You are missing the end date.')]
    public $rangeEnd;

    #[Url]
    public $status = null;

    #[Url]
    public $sortCol = null;

    #[Url]
    public $sortAsc = true;

    // @todo: it would be nice to have cleaner array representation in the query string...
    #[Url]
    public $selectedProductIds = [];

    public $selectedOrderIds = [];

    public $orderIdsOnPage = [];

    public $showRangeDropdown = false;

    public function mount()
    {
        // @todo: because we're setting these values in mount, it overrides the #[Url] binding...
        if (count($this->selectedProductIds) === 0) {
            $this->selectedProductIds = $this->store->products->map(fn($i) => (string) $i->id)->toArray();
        }
    }

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

    public function setCustomRange()
    {
        $this->validate();

        $this->range = 'custom';

        $this->showRangeDropdown = false;
    }

    protected function filterByRange($query)
    {
        switch ($this->range) {
            case 'today':
                $query->whereDate('ordered_at', Carbon::today());
                break;

            case 'last7':
                $query->whereBetween('ordered_at', [Carbon::today()->subDays(6), Carbon::now()]);
                break;

            case 'last30':
                $query->whereBetween('ordered_at', [Carbon::today()->subDays(29), Carbon::now()]);
                break;

            case 'year':
                $query->whereBetween('ordered_at', [Carbon::now()->startOfYear(), Carbon::now()]);
                break;

            case 'custom':
                $start = Carbon::createFromFormat('Y-m-d', $this->rangeStart);
                $end = Carbon::createFromFormat('Y-m-d', $this->rangeEnd);
                $query->whereBetween('ordered_at', [$start, $end]);
                break;

            default:
                # code...
                break;
        }

        return $query;
    }

    protected function filterByStatus($query, $status = null)
    {
        $status = $status ?: $this->status;

        switch ($status) {
            case 'paid':
                $query->where('status', 'paid');
                break;

            case 'refunded':
                $query->where('status', 'refunded');
                break;

            case 'failed':
                $query->where('status', 'failed');
                break;

            default:
                # code...
                break;
        }

        return $query;
    }

    protected function filterByProduct($query) {
        $query->whereIn('product_id', $this->selectedProductIds);

        return $query;
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

        // @todo: find a better way...
        // @todo: make scripts run before dispatches (because /supportEvents is use in imports earlier on...)
        $this->dispatch('update-chart', data: $this->getChartData())->self();

        $this->orderIdsOnPage = $orders->map(fn ($i) => (string) $i->id)->toArray();

        return view('livewire.pages.order.index', [
            'orders' => $orders,
            'products' => $this->store->products,
            'counts' => [
                'all' => $this->filterByRange(Order::whereIn('product_id', $this->selectedProductIds))->count(),
                'paid' => $this->filterByProduct($this->filterByRange($this->filterByStatus(Order::query(), 'paid')))->count(),
                'failed' => $this->filterByProduct($this->filterByRange($this->filterByStatus(Order::query(), 'failed')))->count(),
                'refunded' => $this->filterByProduct($this->filterByRange($this->filterByStatus(Order::query(), 'refunded')))->count(),
            ],
        ]);
    }

    public function getChartData()
    {
        if ($this->range === 'today') {
            $result = Order::select(
                \Illuminate\Support\Facades\DB::raw('HOUR(ordered_at) as hour'),
                \Illuminate\Support\Facades\DB::raw('SUM(amount) as hourly_total')
            )
            ->whereBetween('ordered_at', [Carbon::today()->subDays(1), Carbon::now()])
            ->tap(function ($query) {
                $this->filterByStatus($query);
                $this->filterByProduct($query);
            })
            ->groupBy('hour')
            ->get()
            ->mapWithKeys(function ($i) {
                $label = $i->hour;
                $value = (int) $i->hourly_total;

                return [$label => $value];
            })
            ->toArray();
        } else {
            $result = Order::select(
                \Illuminate\Support\Facades\DB::raw('DATE(ordered_at) as date'),
                \Illuminate\Support\Facades\DB::raw('SUM(amount) as daily_total')
            )
            ->tap(function ($query) {
                $this->filterByStatus($query);
                $this->filterByProduct($query);
            })
            ->where(function ($query) {
                return match ($this->range) {
                    null => $query,
                    'year' => $query->whereBetween('ordered_at', [Carbon::now()->startOfYear(), Carbon::now()]),
                    'last30' => $query->whereBetween('ordered_at', [Carbon::today()->subDays(29), Carbon::now()]),
                    'last7' => $query->whereBetween('ordered_at', [Carbon::today()->subDays(6), Carbon::now()]),
                    'custom' => $query->whereBetween('ordered_at', [Carbon::createFromFormat('Y-m-d', $this->rangeStart), Carbon::createFromFormat('Y-m-d', $this->rangeEnd)]),
                };
            })
            ->groupBy('date')
            ->get()
            ->mapWithKeys(function ($i) {
                $label = $i->date;
                $value = (int) $i->daily_total;

                return [$label => $value];
            })
            ->toArray();
        }

        $labels = array_keys($result);
        $values = array_values($result);

        return [
            'labels' => $labels,
            'values' => $values,
            'max' => max($values),
        ];
    }
}
