<div>
    <x-popover>
        <x-popover.button class="flex items-center gap-2 rounded-lg border pl-3 pr-2 py-1 text-gray-600 text-sm">
            <div>All Products</div>

            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </div>
        </x-popover.button>

        <x-popover.panel class="border border-gray-100 shadow-xl z-10 w-64">
            <div class="flex flex-col divide-y divide-gray-100">
                @foreach ($products as $product)
                    <label class="flex items-center px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100">
                        <input value="{{ $product->id }}" wire:model="selectedProductIds" type="checkbox" class="rounded border-gray-300">

                        <div class="text-sm text-gray-800">{{ $product->name }}</div>
                    </label>
                @endforeach
            </div>
        </x-popover.panel>
    </x-popover>
</div>
