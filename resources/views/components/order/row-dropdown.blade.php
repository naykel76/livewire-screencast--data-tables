@props(['order'])

<x-menu>
    <x-menu.button aria-label="Reveal dropdown" class="rounded hover:bg-gray-100">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
        </svg>
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
