{{-- @todo: need this wire:ignore, otherwise the popover panel will be wonkilly positioned on the left when switching different ranges... --}}
<button type="button" x-popover:button {{ $attributes }}>
    {{ $slot }}
</button>
