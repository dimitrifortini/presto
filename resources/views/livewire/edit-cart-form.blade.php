<p class="mb-0 text-blk">
    <span class="text-secondary">{{ __('ui.quantity') }}</span>
    <span class="fw-semibold">{{ $cart->quantity }}</span>

    <button type="button" wire:click="minus" class="border-0 bg-transparent p-0"
        aria-label="{{ __('ui.decrease_quantity') }}">
        <i class="ms-3 fa-solid fa-minus"></i>
    </button>

    <button type="button" wire:click="plus" class="border-0 bg-transparent p-0"
        aria-label="{{ __('ui.increase_quantity') }}">
        <i class="ms-3 fa-solid fa-plus"></i>
    </button>
</p>