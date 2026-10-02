@section('navbar-class', 'navbar-bg')

<x-layout>
    <main class="container">
        <div class="row justify-content-evenly">

            <div class="col-12 col-lg-5">
                <h1 class="text-center fw-bold my-5">
                    {{ __('ui.shipping_details') }}:
                </h1>

                <form action="{{ route('order.store') }}" method="POST" class="form-box d-flex flex-column">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label" for="full_name">
                            {{ __('ui.full_name') }}
                        </label>
                        <input id="full_name" class="form-control shadow-sm" type="text" readonly
                            value="{{ Auth::user()->name }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="email">
                            {{ __('ui.email') }}
                        </label>
                        <input id="email" class="form-control shadow-sm" type="email" readonly
                            value="{{ Auth::user()->email }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="shipping_address">
                            {{ __('ui.shipping_address') }}
                        </label>
                        <input name="shipping_address" id="shipping_address" class="form-control shadow-sm"
                            type="text" required>
                    </div>

                    <fieldset class="mb-4">
                        <legend class="form-label fw-semibold mb-3">
                            {{ __('ui.payment_method') }}
                        </legend>

                        <div class="row g-3">

                            <div class="col-12 col-md-4">
                                <label class="payment-option w-100 border rounded-3 p-3 text-center h-100">
                                    <input class="form-check-input" type="radio" name="payment_method"
                                        value="card" required>
                                    <i class="fa-solid fa-credit-card fs-2 d-block my-2"></i>
                                    <span class="fw-semibold d-block">
                                        {{ __('ui.card') }}
                                    </span>
                                    <small class="text-secondary">
                                        {{ __('ui.credit_debit_card') }}
                                    </small>
                                </label>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="payment-option w-100 border rounded-3 p-3 text-center h-100">
                                    <input class="form-check-input" type="radio" name="payment_method"
                                        value="paypal">
                                    <i class="fa-brands fa-paypal fs-2 d-block my-2"></i>
                                    <span class="fw-semibold d-block">
                                        {{ __('ui.paypal') }}
                                    </span>
                                    <small class="text-secondary">
                                        {{ __('ui.paypal_payment') }}
                                    </small>
                                </label>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="payment-option w-100 border rounded-3 p-3 text-center h-100">
                                    <input class="form-check-input" type="radio" name="payment_method"
                                        value="cash">
                                    <i class="fa-solid fa-money-bill-wave fs-2 d-block my-2"></i>
                                    <span class="fw-semibold d-block">
                                        {{ __('ui.cash_on_delivery_method') }}
                                    </span>
                                    <small class="text-secondary">
                                        {{ __('ui.cash_on_delivery') }}
                                    </small>
                                </label>
                            </div>

                        </div>
                    </fieldset>

                    <button type="submit" class="btn btn-buy text-white w-100 mt-2">
                        {{ __('ui.confirm_order') }}
                    </button>
                </form>
            </div>

            <div class="col-12 col-lg-6">
                <h2 class="text-center fw-bold my-5">
                    {{ __('ui.order_summary') }}:
                </h2>

                <div class="row justify-content-center">
                    <div class="col-12 mb-4">

                        @foreach ($carts->take(3) as $cart)
                            <article class="border rounded-3 shadow-sm mb-4 p-3">
                                <div class="d-flex align-items-center gap-3">

                                    <a href="{{ route('article.show', $cart->article) }}"
                                        class="flex-shrink-0 square-100">

                                        @if ($cart->article->images->isNotEmpty())
                                            <img src="{{ $cart->article->images->first()->getUrl(300, 300) }}"
                                                alt="{{ __('ui.product_image') }}: {{ $cart->article->title }}"
                                                class="w-100 h-100 object-fit-cover rounded-2">
                                        @else
                                            <img src="/media/placeholder-show/1.png" alt=""
                                                class="w-100 h-100 object-fit-cover rounded-2">
                                        @endif

                                    </a>

                                    <div class="flex-grow-1">
                                        <h3 class="fw-semibold mb-2">
                                            {{ $cart->article->title }}
                                        </h3>

                                        <div class="text-secondary small">
                                            {{ __('ui.quantity') }}: {{ $cart->quantity }}
                                        </div>

                                        <div class="mt-1">
                                            {{ number_format($cart->article->price, 2, ',', '.') }} €
                                            <span class="text-secondary small">
                                                {{ __('ui.per_piece') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <span class="text-secondary small d-block">
                                            {{ __('ui.subtotal') }}
                                        </span>

                                        <span class="fw-bold">
                                            {{ number_format($cart->article->price * $cart->quantity, 2, ',', '.') }} €
                                        </span>
                                    </div>

                                </div>
                            </article>
                        @endforeach

                        @if ($carts->count() > 3)
                            <div class="order-summary-accordion">
                                <div id="moreArticles" class="collapse">

                                    <div class="">
                                        @foreach ($carts->skip(3) as $cart)
                                            <article class="order-item border rounded-3 shadow-sm mb-4 p-3">
                                                <div class="d-flex align-items-center gap-3">

                                                    <a href="{{ route('article.show', $cart->article) }}"
                                                        class="flex-shrink-0 square-100">

                                                        @if ($cart->article->images->isNotEmpty())
                                                            <img src="{{ $cart->article->images->first()->getUrl(300, 300) }}"
                                                                alt="{{ __('ui.product_image') }}: {{ $cart->article->title }}"
                                                                class="w-100 h-100 object-fit-cover rounded-2">
                                                        @else
                                                            <img src="/media/placeholder-show/1.png" alt=""
                                                                class="w-100 h-100 object-fit-cover rounded-2">
                                                        @endif

                                                    </a>

                                                    <div class="flex-grow-1">
                                                        <h3 class="fw-semibold mb-2">
                                                            {{ $cart->article->title }}
                                                        </h3>

                                                        <div class="text-secondary small">
                                                            {{ __('ui.quantity') }}: {{ $cart->quantity }}
                                                        </div>

                                                        <div class="mt-1">
                                                            {{ number_format($cart->article->price, 2, ',', '.') }} €
                                                            <span class="text-secondary small">
                                                                {{ __('ui.per_piece') }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <span class="text-secondary small d-block">
                                                            {{ __('ui.subtotal') }}
                                                        </span>

                                                        <span class="fw-bold">
                                                            {{ number_format($cart->article->price * $cart->quantity, 2, ',', '.') }}
                                                            €
                                                        </span>
                                                    </div>

                                                </div>
                                            </article>
                                        @endforeach
                                    </div>

                                </div>

                                <button type="button" class="show-more-items" data-bs-toggle="collapse"
                                    data-bs-target="#moreArticles" aria-expanded="false"
                                    aria-controls="moreArticles">
                                    <span class="show-more-text">
                                        {{ __('ui.show_more_articles', ['count' => $carts->count() - 3]) }}
                                    </span>

                                    <span class="hide-more-text">
                                        {{ __('ui.hide_articles') }}
                                    </span>
                                </button>
                            </div>
                        @endif

                    </div>

                    <div class="col-12 border-top pt-3 mt-2 text-end">
                        <span class="fs-5 me-3">
                            {{ __('ui.total') }}
                        </span>

                        <strong class="fs-4">
                            {{ number_format($total, 2, ',', '.') }} €
                        </strong>
                    </div>

                </div>
            </div>

        </div>
    </main>
</x-layout>