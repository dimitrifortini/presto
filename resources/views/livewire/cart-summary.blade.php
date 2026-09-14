<div class="col-12 col-lg-3 border rounded-1 shadow d-flex flex-column align-items-center  mt-5 bg-lgray text-blk me-5 ">
    <h2 class="fw-bold my-5">Riepilogo:</h2>
    <div class="w-100 row ">
        <div class="col-12">
            <h3 class="fw-semibold mb-4">Carrello:</h3>
        </div>
        <div class="col-12">
            <div class="row cart-summary-items overflow-auto border rounded-2 p-3 custom-scrollbar">

                @foreach ($carts as $cart)
                    <div class="col-7 d-flex justify-content-start mb-0 ">
                        <p>{{ $cart->article->title }} </p>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <p>{{ $cart->article->price }} €</p>
                    </div>
                    <div class="col-12 mb-5">
                        <p class="fw-semibold">{{ $cart->article->price }} € x {{ $cart->quantity }} Qty. =
                            {{ $cart->article->price * $cart->quantity }} €</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <h3 class="mb-3 fw-semibold mt-5">Totale: <span class="fw-bold">{{ $total }} €</span></h3>
    <small class="text-muted mb-3">{{ __('ui.vat_included') }}</small>
    <small class="text-muted mb-3">Spese di spedizione gratuite</small>
    <a href="{{ route('order.create') }}"><button class="btn btn-buy text-white mt-auto mb-5">Procedi
            all'acquisto</button></a>
</div>
