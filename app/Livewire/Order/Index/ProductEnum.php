<?php

namespace App\Livewire\Order\Index;

enum ProductEnum: string
{
    case All = 'all';

    public function label()
    {
        return (string) str($this->name)->replace('_', ' ');
    }
}
