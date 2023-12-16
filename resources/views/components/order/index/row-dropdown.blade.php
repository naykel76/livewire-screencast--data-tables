@props(['order'])

<x-menu>
    <x-menu.button aria-label="Reveal dropdown" class="rounded hover:bg-gray-100">
        <x-icon.ellipsis-horizontal />
    </x-menu.button>

    <x-menu.items>
        {{-- @todo: form here? or button... --}}
        <x-menu.item
            wire:click="refundOrder({{ $order->id }})"
            x-on:click="menuOpen = false"
            wire:confirm="Are you sure you want to refund this order?"
        >
            Refund
        </x-menu.item>

        <x-menu.item
            wire:click="archiveOrder({{ $order->id }})"
            {{-- This is here to cose the menu after the confirmation dialog is handled... --}}
            x-on:click="menuOpen = false"
            wire:confirm="Are you sure you want to archive this order?"
        >
            Archive
        </x-menu.item>
    </x-menu.items>
</x-menu>
