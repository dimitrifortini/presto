<div class="col-12 col-lg-3 border rounded-1 shadow d-flex flex-column align-items-center mt-5 bg-lgray text-blk me-5">
    <h2 class="fw-bold my-5">
        Riepilogo:
    </h2>
    <div class="w-100 row">
        <div class="col-12">
            <h3 class="fw-semibold mb-4">
                Carrello:
            </h3>
                </div>
        <div class="col-12">            
            <div class="row pt-3">
                @foreach ($carts->take(3) as $cart)
                    <div class="col-7 d-flex justify-content-start mb-0">
                        <p>
                            {{ $cart->article->title }}
                        </p>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <p>
                            {{ $cart->article->price }} €
                        </p>
                    </div>
                    <div class="col-12 mb-4">
                        <p class="fw-semibold">
                            {{ $cart->article->price }} € x {{ $cart->quantity }} Qty. =
                            {{ $cart->article->price * $cart->quantity }} €
                        </p>
                    </div>
                @endforeach
            </div>            
            @if ($carts->count() > 3)
                <div class="cart-summary-accordion">                    
                    <div id="moreCartSummaryItems" class="collapse">
                        <div class="row pb-3">
                            @foreach ($carts->skip(3) as $cart)
                                <div class="col-7 d-flex justify-content-start mb-0">
                                    <p>
                                        {{ $cart->article->title }}
                                    </p>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <p>
                                        {{ $cart->article->price }} €
                                    </p>
                                </div>
                                <div class="col-12 mb-4">
                                    <p class="fw-semibold">
                                        {{ $cart->article->price }} € x {{ $cart->quantity }} Qty. =
                                        {{ $cart->article->price * $cart->quantity }} €
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>                    
                    <button class="cart-summary-toggle show-more-items" type="button" data-bs-toggle="collapse"
                        data-bs-target="#moreCartSummaryItems" aria-expanded="false"
                        aria-controls="moreCartSummaryItems">
                        <span class="show-text">
                            Mostra altri {{ $carts->count() - 3 }} articoli
                        </span>
                        <span class="hide-text">
                            Nascondi articoli
                        </span>
                    </button>
                </div>
            @endif
        </div>
    </div>    
    <div class="cart-summary-total text-center">
        <h3 class="mb-3 fw-semibold">
            Totale:
            <span class="fw-bold">
                {{ $total }} €
            </span>
        </h3>
        <small class="text-muted mb-3 d-block">
            {{ __('ui.vat_included') }}
        </small>
        <small class="text-muted mb-3 d-block">
            Spese di spedizione gratuite
        </small>
    </div>
    <a href="{{ route('order.create') }}">
        <button class="btn btn-buy text-white mb-5">
            Procedi all'acquisto
        </button>
    </a>
</div>
