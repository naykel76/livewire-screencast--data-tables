<div class="w-full flex flex-col gap-8">
    <div class="flex justify-between items-center">
        <h1 class="font-semibold text-3xl text-gray-800">Orders</h1>

        <div class="flex gap-2">
            <x-order.filter-products wire:model.live="selectedProductIds" :$products />

            <x-order.filter-dates :$range />
        </div>
    </div>

    {{-- <x-order.filter-status :$counts :$status /> --}}

    <livewire:pages.order.filter-status wire:model.live="status"
        :$store
        :$status
        :$range
        :$rangeStart
        :$rangeEnd
        :$selectedProductIds
        lazy
    />

    <livewire:pages.order.chart
        :$store
        :$range
        :$rangeStart
        :$rangeEnd
        :$status
        :$selectedProductIds
        lazy
    />

    <livewire:pages.order.table
        :$store
        :$range
        :$rangeStart
        :$rangeEnd
        :$status
        :$selectedProductIds
        lazy
    />
</div>
