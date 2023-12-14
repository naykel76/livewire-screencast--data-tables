<div class="w-full flex flex-col gap-8">
    <div class="flex justify-between items-center">
        <h1 class="font-semibold text-3xl text-gray-800">Orders</h1>

        <div class="flex gap-2">
            {{-- <x-order.filter-products wire:model.live="filters.selectedProductIds" :$products /> --}}

            {{-- <x-order.filter-dates :$filters /> --}}
        </div>
    </div>

    <button type="button" x-bind:id="'hey'">testing</button>

    <button wire:click="$set('filters.status', 'all')">filter</button>

    {{-- <livewire:pages.order.filter-status wire:model.live="filters"
        :$store
        :$filters
        lazy
    /> --}}

    {{-- <livewire:pages.order.chart
        :$store
        :$filters
        lazy
    /> --}}

    <livewire:pages.order.table
        :$store
        :$filters
    />
</div>
