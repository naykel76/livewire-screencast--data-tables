<?php

namespace App\Livewire\ShowOrders;

enum ProductEnum: string
{
    case All = 'all';

    public function label()
    {
        return (string) str($this->name)->replace('_', ' ');
    }
}
