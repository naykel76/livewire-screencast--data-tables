<div class="w-full flex flex-col gap-8">
    <div class="flex justify-between items-center">
        <h1 class="font-semibold text-3xl text-gray-800">Orders</h1>

        <div class="flex gap-2">
            <x-show-orders.filter-products :$filters wire:model.live="filters.selectedProductIds" :$products />

            <x-show-orders.filter-dates :$filters />
        </div>
    </div>

    <livewire:show-orders.filter-status wire:model.live="filters"
        :$store
        :$filters
        lazy
    />

    <livewire:show-orders.chart
        :$store
        :$filters
        lazy
    />

    <livewire:show-orders.table
        :$store
        :$filters
    />
</div>
