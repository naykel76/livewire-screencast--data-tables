@props(['order'])

<x-menu>
    <x-menu.button aria-label="Reveal dropdown" class="rounded hover:bg-gray-100">
        <x-icon.ellipsis-horizontal />
    </x-menu.button>

    <x-menu.items>
        <x-menu.close>
            <x-menu.item
                wire:click="refundOrder({{ $order->id }})"
                wire:confirm="Are you sure you want to refund this order?"
            >
                Refund
            </x-menu.item>
        </x-menu.close>

        <x-menu.close>
            <x-menu.item
                wire:click="archiveOrder({{ $order->id }})"
                wire:confirm="Are you sure you want to archive this order?"
            >
                Archive
            </x-menu.item>
        </x-menu.close>
    </x-menu.items>
</x-menu>
