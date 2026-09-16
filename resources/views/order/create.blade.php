@section('navbar-class', 'navbar-bg')

<x-layout>
    <main class="container">
        <div class="row justify-content-evenly">
            <div class="col-12 col-lg-5">
                <h2 class="text-center fw-bold my-5">Dati Spedizione:</h2>
                <form action="{{ route('order.store') }}" method="POST" class="form-box d-flex flex-column">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">
                            Nome Completo
                        </label>
                        <input class="form-control shadow-sm" type="text" readonly value="{{ Auth::user()->name }}">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">
                            Email
                        </label>
                        <input class="form-control shadow-sm" type="email" readonly value="{{ Auth::user()->email }}">
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="shipping_address">
                            Indirizzo di spedizione
                        </label>
                        <input name="shipping_address" id="shipping_address" class="form-control shadow-sm"
                            type="text" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-3">
                            Metodo di pagamento
                        </label>
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <label class="payment-option w-100 border rounded-3 p-3 text-center h-100">
                                    <input class="form-check-input" type="radio" name="payment_method" value="card"
                                        required>
                                    <i class="fa-solid fa-credit-card fs-2 d-block my-2"></i>
                                    <span class="fw-semibold d-block">
                                        Carta
                                    </span>
                                    <small class="text-secondary">
                                        Carta di credito/debito
                                    </small>
                                </label>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="payment-option w-100 border rounded-3 p-3 text-center h-100">
                                    <input class="form-check-input" type="radio" name="payment_method" value="paypal">
                                    <i class="fa-brands fa-paypal fs-2 d-block my-2"></i>
                                    <span class="fw-semibold d-block">
                                        PayPal
                                    </span>
                                    <small class="text-secondary">
                                        Pagamento tramite PayPal
                                    </small>
                                </label>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="payment-option w-100 border rounded-3 p-3 text-center h-100">
                                    <input class="form-check-input" type="radio" name="payment_method" value="cash">
                                    <i class="fa-solid fa-money-bill-wave fs-2 d-block my-2"></i>
                                    <span class="fw-semibold d-block">
                                        Contrassegno
                                    </span>
                                    <small class="text-secondary">
                                        Paga alla consegna
                                    </small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-buy text-white w-100 mt-2">
                        Conferma ordine
                    </button>
                </form>
            </div>
            <div class="col-12 col-lg-6">
                <h2 class="text-center fw-bold my-5">
                    Riepilogo Ordine:
                </h2>
                <div class="row justify-content-center">
                    <div class="col-12 mb-4">
                        @foreach ($carts->take(3) as $cart)
                            <div class="border rounded-3 shadow-sm mb-4 p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <a href="{{ route('article.show', $cart->article) }}" class="flex-shrink-0 square-100"
                                        >
                                        @if ($cart->article->images->isNotEmpty())
                                            <img src="{{ $cart->article->images->first()->getUrl(300, 300) }}"
                                                alt="Immagine di prodotto"
                                                class=" w-100 h-100 object-fit-cover rounded-2">
                                        @else
                                            <img src="/media/placeholder-show/1.png" alt="Immagine di prodotto"
                                                class="w-100 h-100 object-fit-cover rounded-2">
                                        @endif
                                    </a>
                                    <div class="flex-grow-1">
                                        <h5 class="fw-semibold mb-2">
                                            {{ $cart->article->title }}
                                        </h5>
                                        <div class="text-secondary small">
                                            Quantità: {{ $cart->quantity }}
                                        </div>
                                        <div class="mt-1">
                                            {{ number_format($cart->article->price, 2, ',', '.') }} €
                                            <span class="text-secondary small">
                                                / pezzo
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="text-secondary small d-block">
                                            Subtotale
                                        </span>
                                        <span class="fw-bold">
                                            {{ number_format($cart->article->price * $cart->quantity, 2, ',', '.') }} €
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if ($carts->count() > 3)
                            <div class="order-summary-accordion">
                                <div id="moreArticles" class="collapse">
                                    <div class="">
                                        @foreach ($carts->skip(3) as $cart)
                                            <div class="order-item border rounded-3 shadow-sm mb-4 p-3">
                                                <div class="d-flex align-items-center gap-3">
                                                    <a href="{{ route('article.show', $cart->article) }}"
                                                        class="flex-shrink-0 square-100" >
                                                        @if ($cart->article->images->isNotEmpty())
                                                            <img src="{{ $cart->article->images->first()->getUrl(300, 300) }}"
                                                                alt="Immagine di prodotto"
                                                                class="w-100 h-100 object-fit-cover rounded-2">
                                                        @else
                                                            <img src="/media/placeholder-show/1.png"
                                                                alt="Immagine di prodotto"
                                                                class="w-100 h-100 object-fit-cover rounded-2">
                                                        @endif
                                                    </a>
                                                    <div class="flex-grow-1">
                                                        <h5 class="fw-semibold mb-2">
                                                            {{ $cart->article->title }}
                                                        </h5>
                                                        <div class="text-secondary small">
                                                            Quantità: {{ $cart->quantity }}
                                                        </div>
                                                        <div class="mt-1">
                                                            {{ number_format($cart->article->price, 2, ',', '.') }} €
                                                            <span class="text-secondary small">
                                                                / pezzo
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <span class="text-secondary small d-block">
                                                            Subtotale
                                                        </span>
                                                        <span class="fw-bold">
                                                            {{ number_format($cart->article->price * $cart->quantity, 2, ',', '.') }}
                                                            €
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="button" class="show-more-items" data-bs-toggle="collapse"
                                    data-bs-target="#moreArticles" aria-expanded="false"
                                    aria-controls="moreArticles">
                                    <span class="show-more-text">
                                        Mostra altri {{ $carts->count() - 3 }} articoli
                                    </span>
                                    <span class="hide-more-text">
                                        Nascondi articoli
                                    </span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="col-12 border-top pt-3 mt-2 text-end">
                        <span class="fs-5 me-3">
                            Totale
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
