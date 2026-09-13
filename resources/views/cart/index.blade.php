@section('navbar-position', 'position-absolute')
<x-layout>
    <div class="container-fluid  p-0">
        <div class="row mx-0">
            <div class="col-12 p-0">
                <header class="bg-category  d-flex align-items-end ">
                    <h1 class="fw-bold text-wh category-title pb-2 ps-4 display-4">Il tuo carrello</h1>
                </header>
            </div>
        </div>
    </div>
    <main class="container-fluid px-5">
        <div class="row d-flex justify-content-between px-5">
            <div class="col-12 col-lg-7 col pt-5 ms-lg-5">
                <div class="row mt-5">
                    @foreach ($carts as $cart)
                        <div class=" col-12  border rounded-2 shadow mt-3 mb-5 ps-0 pe-5 position-relative">
                            <form action="{{ route('cart.destroy', $cart) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="position-absolute x-position btn"><i
                                        class="fa-solid fa-xmark text-muted "></i></button>

                            </form>
                            <div class="text-decoration-none text-blk w-100 d-flex align-items-center "
                                >
                                @if ($cart->article->images->isNotEmpty())
                                <a href="{{ route('article.show', $cart->article) }}">
                                    <img src="{{ $cart->article->images->first()->getUrl(300, 300) }}"
                                            alt="Immagine di prodotto" class="rounded-1">
                                    </a>    
                                @else
                                <a href="{{ route('article.show', $cart->article) }}">
                                    <img src="/media/placeholder-show/1.png" alt="Immagine di prodotto"
                                        class="rounded-1 default-img">

                                </a>
                                @endif
                                <div class="flex-grow-1 row align-items-center">

                                   
                                    <div class="col-8 d-flex flex-column align-items-center justify-content-center">
                                        <h3 class="fw-bold mb-4">
                                            {{ $cart->article->title }}
                                        </h3>

                                        <small class="muted">
                                            L'articolo è stato aggiunto il {{ $cart->updated_at }}
                                        </small>
                                    </div>

                                    
                                    <div class="col-4 text-center ">
                                        <h3 class="fw-bold mb-4">
                                            {{ $cart->article->price }} €
                                        </h3>
                                        <livewire:edit-cart-form
                                        :$cart
                                        />                      
                                        
                                     
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div
                class="col-12 col-lg-3 border rounded-1 shadow d-flex flex-column align-items-center  mt-5 bg-lgray text-blk me-5">
                <h2 class="fw-bold my-5">Riepilogo:</h2>
                <div class="w-100 row ">
                    <div class="col-12">
                        <h3 class="fw-semibold mb-4">Carrello:</h3>
                    </div>
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

                <h3 class="mb-3 fw-semibold mt-5">Totale: <span class="fw-bold">{{ $total }} €</span></h3>
                <small class="text-muted mb-3">{{ __('ui.vat_included') }}</small>
                <small class="text-muted mb-3">Spese di spedizione gratuite</small>
                <button class="btn btn-buy text-white mt-auto mb-5">Procedi all'acquisto</button>
            </div>
        </div>
        </div>

    </main>

</x-layout>
