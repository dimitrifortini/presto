<div class="order-detail">

    <h5 class="fw-semibold">
        Dettaglio ordine #{{ $order->id }}
    </h5>

    <div class="order-products">

        @foreach ($order->order_items as $item)
            <div class="order-product d-flex justify-content-between align-items-center">

                <div>
                    <span class="fw-semibold">
                        {{ $item->article->title }}
                    </span>

                    <span class="text-secondary ms-2">
                        x {{ $item->quantity }}
                    </span>
                </div>

                <div>
                    {{ number_format($item->price * $item->quantity, 2, ',', '.') }}
                    €
                </div>

            </div>
        @endforeach

    </div>

    <div class="order-total">

        <span class="text-secondary">
            Totale
        </span>

        <strong>
            {{ number_format($order->total, 2, ',', '.') }} €
        </strong>

    </div>

    <form action="{{ route('admin.update', compact('order')) }}" method="POST" class="order-status-form">

        @csrf
        @method('PUT')

        <label for="orderStatus{{ $order->id }}" class="fw-semibold">
            Stato:
        </label>

        <select name="status" id="orderStatus{{ $order->id }}">

            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                In attesa
            </option>

            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>
                Confermato
            </option>

            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>
                In spedizione
            </option>

            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                Consegnato
            </option>

            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                Cancellato
            </option>

        </select>

        <button type="submit" class="update-order-btn mt-3 ">
            Aggiorna
        </button>

    </form>

</div>
