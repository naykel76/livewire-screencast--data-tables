<?php

namespace App\Livewire\Order\Index;

enum Status: string
{
    case All = 'all';
    case Paid = 'paid';
    case Failed = 'failed';
    case Refunded = 'refunded';

    public function label()
    {
        return match ($this) {
            static::All => 'All',
            static::Paid => 'Paid',
            static::Failed => 'Failed',
            static::Refunded => 'Refunded',
        };
    }
}
