
@section('navbar-position', 'position-absolute')

<x-layout>

    <div class="container-fluid p-0">
        <div class="row mx-0">
            <div class="col-12 p-0">

                <header class="bg-category d-flex align-items-end">

                    <h1 class="fw-bold text-wh category-title pb-2 ps-4 display-4">
                        Il tuo carrello
                    </h1>

                </header>

            </div>
        </div>
    </div>


    @if ($carts->isNotEmpty())

        <main class="container-fluid px-3  px-xl-5">

            <div class="row justify-content-xl-between align-items-start px-0 px-2 px-xl-5">


                {{-- PRODOTTI --}}
                <div class="col-12 col-lg-6 col-xl-6 order-2 order-xl-1 pt-4 pt-xl-5 ms-lg-5">

                    <div class="row mt-3  mt-xl-5">

                        @foreach ($carts as $cart)

                            <div
                                class="col-12 border rounded-2 shadow mt-3 mb-4 mb-xl-5
                                       ps-0 pe-2 pe-xl-5 position-relative"
                            >

                                {{-- DELETE --}}
                                <form
                                    action="{{ route('cart.destroy', $cart) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="position-absolute x-position  btn"
                                    >
                                        <i class="fa-solid fa-xmark text-muted"></i>
                                    </button>
                                </form>


                                <div class="text-decoration-none text-blk w-100 d-flex align-items-center">

                                    {{-- IMAGE --}}
                                    @if ($cart->article->images->isNotEmpty())

                                        <a
                                            href="{{ route('article.show', $cart->article) }}"
                                            class="flex-shrink-0"
                                        >
                                            <img
                                                src="{{ $cart->article->images->first()->getUrl(300, 300) }}"
                                                alt="Immagine di prodotto"
                                                class="rounded-1 m-2 cart-img"
                                            >
                                        </a>

                                    @else

                                        <a
                                            href="{{ route('article.show', $cart->article) }}"
                                            class="ratio ratio-1x1 max-116 flex-shrink-0"
                                        >
                                            <img
                                                src="/media/placeholder-show/1.png"
                                                alt="Immagine di prodotto"
                                                class="rounded-1 object-fit-cover m-2 cart-img"
                                            >
                                        </a>

                                    @endif


                                    {{-- INFO --}}
                                    <div
                                        class="flex-grow-1 row align-items-center ms-2 me-0 py-3 py-xl-0"
                                    >

                                        {{-- TITLE --}}
                                        <div
                                            class="col-12 col-xl-8
                                                   d-flex flex-column
                                                   align-items-center
                                                   align-items-xl-center
                                                   justify-content-center
                                                   text-center text-xl-center"
                                        >

                                            <h3 class="fw-bold mt-1 mt-xl-0 mb-2 mb-xl-4">
                                                {{ $cart->article->title }}
                                            </h3>

                                            <small class="text-secondary d-none d-xl-block">
                                                Articolo aggiunto il
                                                {{ $cart->updated_at->translatedFormat('d F Y') }}
                                            </small>

                                        </div>


                                        {{-- PRICE + QUANTITY --}}
                                        <div
                                            class="col-12 col-xl-4
                                                   text-center
                                                   mt-3 mt-xl-0"
                                        >

                                            <h3 class="fw-bold mb-2 mb-xl-4">
                                                {{ $cart->article->price }} €
                                            </h3>

                                            <livewire:edit-cart-form :$cart />

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>


                {{-- SUMMARY --}}
                

                    <livewire:cart-summary :$carts />

                

            </div>

        </main>

    @else

        <h2 class="h1 text-center fw-bold my-5">
            Al momento non sono presenti articoli.
        </h2>

    @endif

</x-layout>