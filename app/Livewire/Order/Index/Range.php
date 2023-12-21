<?php

namespace App\Livewire\Order\Index;

use Illuminate\Support\Carbon;

enum Range: string
{
    case All_Time = 'all';
    case Year = 'year';
    case Last_30 = 'last30';
    case Last_7 = 'last7';
    case Today = 'today';

    public function label()
    {
        return match ($this) {
            static::All_Time => 'All Time',
            static::Year => 'This Year',
            static::Last_30 => 'Last 30 Days',
            static::Last_7 => 'Last 7 Days',
            static::Today => 'Today',
        };
    }

    public function dates()
    {
        return match ($this) {
            static::Today => [Carbon::today(), now()],
            static::Last_7 => [Carbon::today()->subDays(6), now()],
            static::Last_30 => [Carbon::today()->subDays(29), now()],
            static::Year => [Carbon::now()->startOfYear(), now()],
        };
    }
}
