<div class="w-full flex flex-col gap-8">
    <div class="flex justify-between items-center">
        <div class="flex flex-col gap-1">
           <h1 class="font-semibold text-3xl text-gray-800">Orders</h1>

           <p class="text-sm text-gray-500">{{ $store->name }}</p>
        </div>

        <div class="flex gap-2">
            <x-order.index.filter-products :$filters />

            <x-order.index.filter-range :$filters />
        </div>
    </div>

    <x-order.index.filter-status :$filters />

    <livewire:order.index.chart :$store :$filters lazy />

    <livewire:order.index.table :$store :$filters lazy />
</div>
