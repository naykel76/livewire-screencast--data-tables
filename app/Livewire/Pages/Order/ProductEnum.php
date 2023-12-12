<?php

namespace App\Livewire\Pages\Order;

enum ProductEnum: string
{
    case All = 'all';

    public function label()
    {
        return (string) str($this->name)->replace('_', ' ');
    }
}
