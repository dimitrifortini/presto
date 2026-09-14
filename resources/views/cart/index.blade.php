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
    @if ($carts->isNotEmpty())
     <main class="container-fluid px-5">
        <div class="row d-flex justify-content-between align-items-start px-5">
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
                            <div class="text-decoration-none text-blk w-100 d-flex align-items-center ">
                                @if ($cart->article->images->isNotEmpty())
                                    <a href="{{ route('article.show', $cart->article) }}" class="cart-img overflow-hidden">
                                        <img src="{{ $cart->article->images->first()->getUrl(300, 300) }}"
                                            alt="Immagine di prodotto" class="rounded-1  card-img">
                                    </a>
                                @else
                                    <a href="{{ route('article.show', $cart->article) }}" class="ratio ratio-1x1 max-300 cart-img overflow-hidden">
                                        
                                            <img src="/media/placeholder-show/1.png" alt="Immagine di prodotto"
                                            class="rounded-1 default-img object-fit-cover  card-img ">

                                        

                                       

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
                                        <livewire:edit-cart-form :$cart />


                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <livewire:cart-summary :$carts  />
        </div>


    </main>
    @else
    <h2 class="h1 text-center fw-bold my-5">Al momento non sono presenti articoli.</h2>   
    @endif
    

</x-layout>
