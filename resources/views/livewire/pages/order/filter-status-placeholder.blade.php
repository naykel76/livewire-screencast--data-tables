@props(['counts', 'status'])

<div class="grid grid-cols-4 gap-2">
    <button
        wire:click="$set('status', null)"
        @class([
            'px-3 py-2 flex flex-col rounded-xl border hover:border-blue-400 text-gray-700',
            'text-gray-700' => $status !== null,
            'text-blue-600 border-2 border-blue-400' => $status === null,
        ])
    >
        <div class="text-sm font-normal">All</div>
        <div class="text-lg font-semibold">{{ $counts['all'] }}</div>
    </button>

    <button
        wire:click="$set('status', 'paid')"
        @class([
            'px-3 py-2 flex flex-col rounded-xl border hover:border-blue-400 text-gray-700',
            'text-gray-700' => $status !== 'paid',
            'text-blue-600 border-2 border-blue-400' => $status === 'paid',
        ])
    >
        <div class="text-sm font-normal">Paid</div>
        <div class="text-lg font-semibold">{{ $counts['paid'] }}</div>
    </button>

    <button
        wire:click="$set('status', 'failed')"
        @class([
            'px-3 py-2 flex flex-col rounded-xl border hover:border-blue-400 text-gray-700',
            'text-gray-700' => $status !== 'failed',
            'text-blue-600 border-2 border-blue-400' => $status === 'failed',
        ])
    >
        <div class="text-sm font-normal">Failed</div>
        <div class="text-lg font-semibold">{{ $counts['failed'] }}</div>
    </button>

    <button
        wire:click="$set('status', 'refunded')"
        @class([
            'px-3 py-2 flex flex-col rounded-xl border hover:border-blue-400 text-gray-700',
            'text-gray-700' => $status !== 'refunded',
            'text-blue-600 border-2 border-blue-400' => $status === 'refunded',
        ])
    >
        <div class="text-sm font-normal">Refunded</div>
        <div class="text-lg font-semibold">{{ $counts['refunded'] }}</div>
    </button>
</div>
