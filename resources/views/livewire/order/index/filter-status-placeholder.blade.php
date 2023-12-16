<div class="grid grid-cols-4 gap-2">
    @foreach ($statuses as $status)
        <button
            @class([
                'px-3 py-2 flex flex-col rounded-xl border hover:border-blue-400 text-gray-700',
                'text-gray-700' => ! $status['current'],
                'text-blue-600 border-2 border-blue-400' => $status['current'],
            ])
        >
            <div class="text-sm font-normal">{{ $status['label'] }}</div>
            <div class="text-lg font-semibold">{{ $status['count'] }}</div>
        </button>
    @endforeach
</div>
