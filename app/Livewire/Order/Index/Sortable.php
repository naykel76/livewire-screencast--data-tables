<?php

namespace App\Livewire\Order\Index;

use Livewire\Attributes\Url;

trait Sortable
{
    #[Url]
    public $sortCol;

    #[Url]
    public $sortAsc;

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
}
