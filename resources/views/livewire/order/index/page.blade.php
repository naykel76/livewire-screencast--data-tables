<div class="w-full flex flex-col gap-8">
    <div class="flex justify-between items-center">
        <h1 class="font-semibold text-3xl text-gray-800">Orders</h1>

        <div class="flex gap-2">
            <x-order.index.filter-products :$filters wire:model.live="filters.selectedProductIds" :$products />

            <x-order.index.filter-dates :$filters />
        </div>
    </div>

    <livewire:order.index.filter-status wire:model.live="filters"
        :$store
        :$filters
        lazy
    />

    <livewire:order.index.chart
        :$store
        :$filters
        lazy
    />

    <livewire:order.index.table
        :$store
        :$filters
    />
</div>
