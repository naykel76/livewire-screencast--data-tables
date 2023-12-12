@props(['range'])

<div>
    <x-popover wire:model="showRangeDropdown">
        <x-popover.button class="flex items-center gap-2 rounded-lg border pl-3 pr-2 py-1 text-gray-600 text-sm">
            <div>
                @switch($range)
                    @case('today')
                        Today
                        @break
                    @case('last7')
                        Last 7 days
                        @break
                    @case('last30')
                        Last 30 days
                        @break
                    @case('year')
                        Year to date
                        @break
                    @case('custom')
                        {{ $this->rangeStart }} - {{ $this->rangeEnd }}
                        @break

                    @default
                        All time
                @endswitch
            </div>

            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </div>
        </x-popover.button>

        <x-popover.panel class="border border-gray-100 shadow-xl z-10" position="bottom-end">
            <div x-data="{ showPicker: false }">
                <div x-show="! showPicker" class="flex flex-col divide-y divide-gray-100 w-64">
                    {{-- @todo: cant wrap in x-popover.close because it messes with flex width styling...  --}}
                    <button wire:click="$set('range', 'today')" x-on:click="$popover.close()" class="flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100">
                        <div class="text-sm">Today</div>

                        @if ($range === 'today')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </button>

                    <button wire:click="$set('range', 'last7')" x-on:click="$popover.close()" class="flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100">
                        <div class="text-sm">Last 7 Days</div>

                        @if ($range === 'last7')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </button>

                    <button wire:click="$set('range', 'last30')" x-on:click="$popover.close()" class="flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100">
                        <div class="text-sm">Last 30 Days</div>

                        @if ($range === 'last30')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </button>

                    <button wire:click="$set('range', 'year')" x-on:click="$popover.close()" class="flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100">
                        <div class="text-sm">This year</div>

                        @if ($range === 'year')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </button>

                    <button wire:click="$set('range', null)" x-on:click="$popover.close()" class="flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100">
                        <div class="text-sm">All time</div>

                        @if ($range === null)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </button>

                    <button x-on:click="showPicker = true" class="flex items-center justify-between px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100">
                        <div class="text-sm text-gray-800">Custom range</div>

                        <div class="text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>
                    </button>
                </div>

                <div x-show="showPicker">
                    <div class="flex flex-col divide-y divide-gray-100 w-128">
                        <button x-on:click="showPicker = false" class="flex items-center px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100">
                            <div class="text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                </svg>
                            </div>
                        </button>

                        <div class="flex flex-col px-3 pt-3 pb-2 gap-4">
                            <span class="font-semibold text-gray-800">Is between:</span>

                            <div class="flex justify-between items-center gap-2">
                                <input wire:model="rangeStart" type="date" class="text-gray-700 rounded border border-gray-300 bg-white px-2 py-1">

                                <span class="text-sm text-gray-700">and</span>

                                <input wire:model="rangeEnd" type="date" class="text-gray-700 rounded border border-gray-300 bg-white px-2 py-1">
                            </div>

                            @if ($errors->any())
                                <div>
                                    <div class="text-sm text-red-600">{{ $errors->first('rangeStart') }}</div>
                                    <div class="text-sm text-red-600">{{ $errors->first('rangeEnd') }}</div>
                                </div>
                            @endif

                            <div class="flex">
                                <button wire:click="setCustomRange" type="button" class="w-full flex justify-center items-center gap-2 rounded-lg border border-blue-600 px-3 py-1.5 bg-blue-500 font-medium text-sm text-white hover:bg-blue-600">
                                    Apply
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-popover.panel>
    </x-popover>
</div>
