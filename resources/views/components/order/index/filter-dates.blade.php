@props(['filters'])

<div>
    <x-popover wire:model="showRangeDropdown">
        <x-popover.button class="flex items-center gap-2 rounded-lg border pl-3 pr-2 py-1 text-gray-600 text-sm">
            <div>
                {{ $filters->range->label(
                    $this->filters->start,
                    $this->filters->end,
                ) }}
            </div>

            <x-icon.chevron-down />
        </x-popover.button>

        <x-popover.panel class="border border-gray-100 shadow-xl z-10" position="bottom-end">
            <div x-data="{ showPicker: false }">
                <div x-show="! showPicker" class="flex flex-col divide-y divide-gray-100 w-64">
                    @foreach ($filters->range::cases() as $range)
                        @unless ($range === $filters->range::Custom)
                            {{-- @todo: cant wrap in x-popover.close because it messes with flex width styling...  --}}
                            <button wire:click="$set('filters.range', '{{ $range }}')" x-on:click="$popover.close()" class="flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100">
                                <div class="text-sm">{{ $range->label() }}</div>

                                @if ($filters->range === $range)
                                    <x-icon.check />
                                @endif
                            </button>
                        @else
                            <button x-on:click="showPicker = true" class="flex items-center justify-between px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100">
                                <div class="text-sm text-gray-800">Custom range</div>

                                <div class="text-gray-500">
                                    <x-icon.chevron-right />
                                </div>
                            </button>
                        @endunless
                    @endforeach
                </div>

                <div x-show="showPicker">
                    <div class="flex flex-col divide-y divide-gray-100 w-128">
                        <button x-on:click="showPicker = false" class="flex items-center px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100">
                            <div class="text-gray-500">
                                <x-icon.chevron-left />
                            </div>
                        </button>

                        <div class="flex flex-col px-3 pt-3 pb-2 gap-4">
                            <span class="font-semibold text-gray-800">Is between:</span>

                            <div class="flex justify-between items-center gap-2">
                                <input wire:model="filters.start" type="date" class="text-gray-700 rounded border border-gray-300 bg-white px-2 py-1">

                                <span class="text-sm text-gray-700">and</span>

                                <input wire:model="filters.end" type="date" class="text-gray-700 rounded border border-gray-300 bg-white px-2 py-1">
                            </div>

                            @if ($errors->any())
                                <div>
                                    <div class="text-sm text-red-600">{{ $errors->first('filters.start') }}</div>
                                    <div class="text-sm text-red-600">{{ $errors->first('filters.end') }}</div>
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
