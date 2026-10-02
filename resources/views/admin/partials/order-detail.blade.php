
<section class="order-detail">

    <h2 class="fw-semibold">
        {{ __('ui.order_detail') }} #{{ $order->id }}
    </h2>

    <ul class="order-products">

        @foreach ($order->order_items as $item)
            <li class="order-product d-flex justify-content-between align-items-center">

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

            </li>
        @endforeach

    </ul>

    <div class="order-total">

        <span class="text-secondary">
            {{ __('ui.total') }}
        </span>

        <strong>
            {{ number_format($order->total, 2, ',', '.') }} €
        </strong>

    </div>

    <form action="{{ route('admin.update', compact('order')) }}" method="POST" class="order-status-form">

        @csrf
        @method('PUT')

        <label for="orderStatus{{ $order->id }}" class="fw-semibold">
            {{ __('ui.status') }}:
        </label>

        <select name="status" id="orderStatus{{ $order->id }}">

            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                {{ __('ui.pending') }}
            </option>

            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>
                {{ __('ui.confirmed') }}
            </option>

            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>
                {{ __('ui.shipped') }}
            </option>

            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                {{ __('ui.delivered') }}
            </option>

            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                {{ __('ui.cancelled') }}
            </option>

        </select>

        <button type="submit" class="update-order-btn  ">
            {{ __('ui.update') }}
        </button>

    </form>

</section>
