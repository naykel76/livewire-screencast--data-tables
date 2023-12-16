<?php

namespace App\Livewire\Order\Index;

use Illuminate\Support\Carbon;

enum Range: string
{
    case All_Time = 'all';
    case Today = 'today';
    case Last_7 = 'last7';
    case Last_30 = 'last30';
    case Year = 'year';
    case Custom = 'custom';

    public function label($start = null, $end = null)
    {
        return match ($this) {
            static::All_Time => 'All Time',
            static::Today => 'All Time',
            static::Last_7 => 'Last 7 Days',
            static::Last_30 => 'Last 30 Days',
            static::Year => 'Year',
            static::Custom => ($start && $end)
                ? "{$start} - {$end}"
                : 'Custom',
        };
    }

    public function dates($start, $end)
    {
        return match ($this) {
            // @todo: what to do here:
            static::All_Time => [Carbon::now()->subYears(10), now()],

            static::Today => [Carbon::today(), now()],
            static::Last_7 => [Carbon::today()->subDays(6), now()],
            static::Last_30 => [Carbon::today()->subDays(29), now()],
            static::Year => [Carbon::now()->startOfYear(), now()],
            static::Custom => [
                Carbon::createFromFormat('Y-m-d', $start),
                Carbon::createFromFormat('Y-m-d', $end),
            ],
        };
    }
}
