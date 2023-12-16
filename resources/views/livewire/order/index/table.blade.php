<div class="flex flex-col gap-8">
    <div class="grid grid-cols-2 gap-2">
        <x-order.index.search />

        <x-order.index.bulk-actions />
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
                                <x-order.index.check-all />
                            </div>
                        </th>

                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <button wire:click="sortBy('number')" type="button" class="flex items-center gap-2 group">
                                <div>Order #</div>

                                @if ($sortCol === 'number')
                                    <div class="text-gray-400">
                                        @if ($sortAsc)
                                            <x-icon.arrow-long-up />
                                        @else
                                            <x-icon.arrow-long-down />
                                        @endif
                                    </div>
                                @else
                                    <div class="text-gray-400 opacity-0 group-hover:opacity-100">
                                        <x-icon.arrows-up-down />
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
                                            <x-icon.arrow-long-up />
                                        @else
                                            <x-icon.arrow-long-down />
                                        @endif
                                    </div>
                                @else
                                    <div class="text-gray-400 opacity-0 group-hover:opacity-100">
                                        <x-icon.arrows-up-down />
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
                                            <x-icon.arrow-long-up />
                                        @else
                                            <x-icon.arrow-long-down />
                                        @endif
                                    </div>
                                @else
                                    <div class="text-gray-400 opacity-0 group-hover:opacity-100">
                                        <x-icon.arrows-up-down />
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
                                            <x-icon.arrow-long-up />
                                        @else
                                            <x-icon.arrow-long-down />
                                        @endif
                                    </div>
                                @else
                                    <div class="text-gray-400 opacity-0 group-hover:opacity-100">
                                        <x-icon.arrows-up-down />
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
                                            <x-icon.check />
                                        </div>
                                    </div>
                                @elseif ($order->status === 'failed')
                                    <div class="rounded-full py-0.5 pl-2 pr-1 inline-flex font-medium items-center gap-1 text-red-600 text-xs bg-red-100 opacity-75">
                                        <div>{{ str($order->status)->title() }}</div>
                                        <div>
                                            <x-icon.x-mark />
                                        </div>
                                    </div>
                                @elseif ($order->status === 'pending')
                                    <div class="rounded-full py-0.5 pl-2 pr-1 inline-flex font-medium items-center gap-1 text-gray-600 text-xs bg-gray-100 opacity-75">
                                        <div>{{ str($order->status)->title() }}</div>
                                        <div>
                                            <x-icon.clock />
                                        </div>
                                    </div>
                                @elseif ($order->status === 'refunded')
                                    <div class="rounded-full py-0.5 pl-2 pr-1 inline-flex font-medium items-center gap-1 text-purple-600 text-xs bg-purple-100 opacity-75">
                                        <div>{{ str($order->status)->title() }}</div>
                                        <div>
                                            <x-icon.arrow-uturn-left />
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
                                    <x-order.index.row-dropdown :$order />
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
                    <x-icon.spinner size="10" class="text-gray-700" />
                </div>
            </div>
        </div>

        <div class="pt-4 flex justify-between items-center">
            <div class="text-gray-700 text-sm">
                Results: {{ \Illuminate\Support\Number::format($orders->total()) }}
            </div>

            <x-order.index.pagination :$orders />
        </div>
    </div>
</div>
