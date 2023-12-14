<?php

namespace App\Livewire\Pages\Order;

use Illuminate\Support\Carbon;

trait HasOrderFilters
{
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
}
