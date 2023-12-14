<div class="flex flex-col gap-8">
    <div class="grid grid-cols-2 gap-2">
        {{-- <x-order.search />

        <x-order.bulk-actions /> --}}
    </div>

    <div x-data="{ open: false }" x-show="open" x-transition.opacity.duration.500ms x-init="setTimeout(() => open = true)">
        <div class="relative">
            <table class="min-w-full table-fixed divide-y divide-gray-300 text-gray-800">
                <thead>
                    <tr>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <div class="flex items-center">
                                {{-- @todo: this would be a nice API: --}}
                                {{-- <x-order.check-all wire:model="selectedProductIds" wire:bind="orderIdsOnPage" /> --}}
                                {{-- <x-order.check-all /> --}}
                            </div>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <button wire:click="sortBy('number')" type="button" class="flex items-center gap-2 group">
                                <div>Order #</div>
                                @if ($sortCol === 'number')
                                    <div class="text-gray-400">
                                        @if ($sortAsc)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                @else
                                    <div class="text-gray-400 opacity-0 group-hover:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                            <path fill-rule="evenodd" d="M2.24 6.8a.75.75 0 001.06-.04l1.95-2.1v8.59a.75.75 0 001.5 0V4.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0L2.2 5.74a.75.75 0 00.04 1.06zm8 6.4a.75.75 0 00-.04 1.06l3.25 3.5a.75.75 0 001.1 0l3.25-3.5a.75.75 0 10-1.1-1.02l-1.95 2.1V6.75a.75.75 0 00-1.5 0v8.59l-1.95-2.1a.75.75 0 00-1.06-.04z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                            </button>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <button wire:click="sortBy('status')" type="button" class="flex items-center gap-2 group">
                                <div>Status</div>
                                @if ($sortCol === 'status')
                                    <div class="text-gray-400">
                                        @if ($sortAsc)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                @else
                                    <div class="text-gray-400 opacity-0 group-hover:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                            <path fill-rule="evenodd" d="M2.24 6.8a.75.75 0 001.06-.04l1.95-2.1v8.59a.75.75 0 001.5 0V4.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0L2.2 5.74a.75.75 0 00.04 1.06zm8 6.4a.75.75 0 00-.04 1.06l3.25 3.5a.75.75 0 001.1 0l3.25-3.5a.75.75 0 10-1.1-1.02l-1.95 2.1V6.75a.75.75 0 00-1.5 0v8.59l-1.95-2.1a.75.75 0 00-1.06-.04z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                            </button>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <div class="flex items-center gap-2 group">
                                <div>Customer</div>
                            </div>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <button wire:click="sortBy('date')" type="button" class="flex items-center gap-2 group">
                                <div>Date</div>
                                @if ($sortCol === 'date')
                                    <div class="text-gray-400">
                                        @if ($sortAsc)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                @else
                                    <div class="text-gray-400 opacity-0 group-hover:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                            <path fill-rule="evenodd" d="M2.24 6.8a.75.75 0 001.06-.04l1.95-2.1v8.59a.75.75 0 001.5 0V4.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0L2.2 5.74a.75.75 0 00.04 1.06zm8 6.4a.75.75 0 00-.04 1.06l3.25 3.5a.75.75 0 001.1 0l3.25-3.5a.75.75 0 10-1.1-1.02l-1.95 2.1V6.75a.75.75 0 00-1.5 0v8.59l-1.95-2.1a.75.75 0 00-1.06-.04z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                            </button>
                        </th>
                        <th class="w-auto p-3 text-left flex justify-end text-sm font-semibold text-gray-900">
                            <button wire:click="sortBy('amount')" type="button" class="flex flex-row-reverse items-center gap-2 group">
                                <div>Amount</div>
                                @if ($sortCol === 'amount')
                                    <div class="text-gray-400">
                                        @if ($sortAsc)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                @else
                                    <div class="text-gray-400 opacity-0 group-hover:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                            <path fill-rule="evenodd" d="M2.24 6.8a.75.75 0 001.06-.04l1.95-2.1v8.59a.75.75 0 001.5 0V4.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0L2.2 5.74a.75.75 0 00.04 1.06zm8 6.4a.75.75 0 00-.04 1.06l3.25 3.5a.75.75 0 001.1 0l3.25-3.5a.75.75 0 10-1.1-1.02l-1.95 2.1V6.75a.75.75 0 00-1.5 0v8.59l-1.95-2.1a.75.75 0 00-1.06-.04z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                            </button>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            {{-- ... --}}
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white text-gray-700">
                    @foreach ($orders as $order)
                        <tr wire:key="{{ $order->id }}">
                            <td class="whitespace-nowrap p-3 text-sm">
                                <div class="flex items-center">
                                    <input type="checkbox" value="{{ $order->id }}" wire:model="selectedOrderIds" class="rounded border-gray-300 shadow">
                                </div>
                            </td>
                            <td class="whitespace-nowrap p-3 text-sm">
                                <div class="flex gap-1">
                                    <span class="text-gray-300">#</span>
                                    {{ $order->number }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap p-3 text-sm">
                                @if ($order->status === 'paid')
                                    <div class="rounded-full py-0.5 pl-2 pr-1 inline-flex font-medium items-center gap-1 text-green-600 text-xs bg-green-100 opacity-75">
                                        <div>{{ str($order->status)->title() }}</div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                        </div>
                                    </div>
                                @elseif ($order->status === 'failed')
                                    <div class="rounded-full py-0.5 pl-2 pr-1 inline-flex font-medium items-center gap-1 text-red-600 text-xs bg-red-100 opacity-75">
                                        <div>{{ str($order->status)->title() }}</div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </div>
                                    </div>
                                @elseif ($order->status === 'pending')
                                    <div class="rounded-full py-0.5 pl-2 pr-1 inline-flex font-medium items-center gap-1 text-gray-600 text-xs bg-gray-100 opacity-75">
                                        <div>{{ str($order->status)->title() }}</div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                @elseif ($order->status === 'refunded')
                                    <div class="rounded-full py-0.5 pl-2 pr-1 inline-flex font-medium items-center gap-1 text-purple-600 text-xs bg-purple-100 opacity-75">
                                        <div>{{ str($order->status)->title() }}</div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                                            </svg>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td class="whitespace-nowrap p-3 text-sm">
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 rounded-full overflow-hidden">
                                        <img src="{{ $order->avatar }}" alt="Customer avatar">
                                    </div>
                                    <div>{{ $order->email }}</div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap p-3 text-sm">
                                {{ $order->ordered_at->format($order->ordered_at->year === now()->year ? 'M d, g:i A' : 'M d, Y, g:i A') }}
                            </td>
                            <td class="w-auto whitespace-nowrap p-3 text-sm text-gray-800 font-semibold text-right">
                                {{ Number::currency($order->amount) }}
                            </td>
                            <td class="whitespace-nowrap p-3 text-sm">
                                <div class="flex items-center justify-end">
                                    {{-- <x-order.row-dropdown :$order /> --}}
                                    <span x-text="'hey'"></span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div wire:loading class="absolute inset-0 bg-white opacity-50">
                {{--  --}}
            </div>

            <div wire:loading.flex class="absolute inset-0 flex justify-center items-center">
                <div>
                    <svg class="animate-spin h-10 w-10 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>
        </div>


        <div class="pt-4 flex justify-between items-center">
            <div class="text-gray-700 text-sm">
                Results: {{ \Illuminate\Support\Number::format($orders->total()) }}
            </div>

            <x-order.pagination :$orders />
        </div>
    </div>
</div>
