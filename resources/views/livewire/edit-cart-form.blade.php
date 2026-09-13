<p class="mb-0">
    Qty.
    <span class="fw-semibold">{{ $cart->quantity }}</span>

    <span role="button" wire:click="minus">
        <i class="ms-3 fa-solid fa-minus"></i>
    </span>

    <span role="button" wire:click="plus">
        <i class="ms-3 fa-solid fa-plus"></i>
    </span>
</p>