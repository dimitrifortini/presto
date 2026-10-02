@section('navbar-class', 'navbar-bg')
<x-layout>
    <main class="container my-5">
        <div class="row">
            <div class="col-12 col-md-7 text-center">
                @if ($article->images->count())
                    {{-- SWIPER DB IMAGES --}}
                    <div class="swiper mySwiper2">
                        <div class="swiper-wrapper">
                            @foreach ($article->images as $key => $image)
                                <div class="swiper-slide swiper-slide-show">
                                    <img src="{{ $image->getUrl(300, 300) }}"
                                        alt="Immagine {{ $key + 1 }} dell'articolo {{ $article->title }}"
                                        class="zoomable-image" />
                                </div>
                            @endforeach
                        </div>

                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                    <div thumbsSlider="" class="swiper mySwiper3">
                        <div class="swiper-wrapper">
                            @foreach ($article->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ $image->getUrl(300, 300) }}" alt="" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- SWIPER DB IMAGES END --}}
                @else
                    {{-- SWIPER DEFAULT IMAGES --}}
                    <div class="swiper mySwiper2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide swiper-slide-show">
                                <img src="/media/placeholder-show/1.png" class="zoomable-image" alt="" />
                            </div>

                            <div class="swiper-slide swiper-slide-show">
                                <img src="/media/placeholder-show/2.png" class="zoomable-image" alt="" />
                            </div>

                            <div class="swiper-slide swiper-slide-show">
                                <img src="/media/placeholder-show/3.png" class="zoomable-image" alt="" />
                            </div>

                            <div class="swiper-slide swiper-slide-show">
                                <img src="/media/placeholder-show/5.png" class="zoomable-image" alt="" />
                            </div>
                        </div>

                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                    <div thumbsSlider="" class="swiper mySwiper3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="/media/placeholder-show/1.png" alt="" />
                            </div>

                            <div class="swiper-slide">
                                <img src="/media/placeholder-show/2.png" alt="" />
                            </div>

                            <div class="swiper-slide">
                                <img src="/media/placeholder-show/3.png" alt="" />
                            </div>

                            <div class="swiper-slide">
                                <img src="/media/placeholder-show/5.png" alt="" />
                            </div>
                        </div>
                    </div>
                @endif
                {{-- SWIPER END DEFAULT IMAGES --}}
            </div>

            <div
                class="col-12 col-md-4 d-flex flex-column align-items-lg-start align-items-center justify-content-center mt-md-3 ps-lg-5 m-show-mobile">

                <h1 class="fw-semibold mb-2 product-title">{{ $article->title }}</h1>

                <p class="h4 text-secondary fst-italic mb-4">
                    #{{ __('ui.' . $article->category->name) }}
                </p>

                <h2 class="h1 fw-bold h2 mb-1">{{ $article->price }} €</h2>

                <p class="text-muted mb-3">{{ __('ui.vat_included') }}</p>

                <form class="text-center text-md-start"
                    action="{{ route('cart.store', ['article' => $article]) }}"
                    id="cartShowForm" method="POST">
                    @csrf

                    <label for="quantityShow" class="text-muted">Qty.</label>

                    <input type="number" id="quantityShow" name="quantity" min="1"
                        step="1" value="1" class="w-50 mb-5">
                </form>

                <button type="submit" class="btn-buy btn-detail" form="cartShowForm">
                    {{ __('ui.add_to_cart') }}
                </button>
            </div>

            <div class="col-12 mt-5 d-none d-lg-block">
                <x-desktop-accordion :$article :$reviews></x-desktop-accordion>
            </div>

            <div class="col-12 mt-5 d-lg-none">
                <x-mobile-accordion :$article :$reviews></x-mobile-accordion>
            </div>
        </div>
    </main>
</x-layout>