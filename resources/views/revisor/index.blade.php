@section('navbar-position', 'position-absolute')
<x-layout>
    <main>
        <div class="container-fluid ">
            <div class="row">
                <div class="col-12 bg-category d-flex align-items-end">
                    <h1 class="fw-bold title-category display-4 text-wh ps-3 pb-2">Revisor Dashboard</h1>
                </div>
            </div>
        </div>
        @if (session()->has('message'))
            <div class="row justify-content-center">
                <div class="col-5 alert alert-success text-center shadow rounded mt-3">
                    {{ session('message') }}
                </div>
            </div>
        @endif
        @if (session()->has('error_message'))
            <div class="row justify-content-center">
                <div class="col-5 alert alert-danger mt-3 text-center shadow rounded">
                    {{ session('error_message') }}
                </div>
            </div>
        @endif
        @if ($article_to_check)
            <main class="container my-5">
                <div class="row">
                    <div class="col-12 col-md-7 text-center">
                        @if ($article_to_check->images->count())
                            {{-- SWIPER DB IMAGES --}}
                            <div class="swiper mySwiper2">
                                <div class="swiper-wrapper  ">
                                    @foreach ($article_to_check->images as $key => $image)
                                        <div class="swiper-slide  ">
                                            <div class="row mx-0 ">
                                                <div class="col-12 swiper-slide-image ">
                                                    <img src="{{ $image->getUrl(300, 300) }}"
                                                        alt="Immagine {{ $key + 1 }} dell'articolo {{ $article_to_check->title }}" />

                                                </div>

                                                <div class="col-12 swiper-slide-text">
                                                    <div class="col-12 mt-3">
                                                        <h5 class="fw-semibold">Labels:</h5>
                                                        @if ($image->labels)
                                                            @foreach ($image->labels as $label)
                                                                <span
                                                                    class="fst-italic text-secondary">#{{ $label }}</span>
                                                            @endforeach
                                                        @else
                                                            <p class="fst-italic">No-labels</p>
                                                        @endif
                                                    </div>
                                                    <h5 class="col-12 mt-3 fw-semibold">Ratings:</h5>
                                                    <div class="col-12">
                                                        <div class="row  justify-content-center">
                                                            <div
                                                                class="col-xl-2 col-4  d-flex justify-content-start align-items-center">
                                                                <div class=" text-center me-3 {{ $image->adult }}">
                                                                </div>
                                                                <div class="text-pr text-secondary">Adult</div>
                                                            </div>
                                                            <div
                                                                class="col-xl-2 col-4 d-flex justify-content-start align-items-center">
                                                                <div class="text-center me-3 {{ $image->medical }}">
                                                                </div>
                                                                <div class="text-pr text-secondary">Medical</div>
                                                            </div>
                                                            <div
                                                                class="col-xl-2 col-4 d-flex justify-content-start align-items-center">
                                                                <div class="text-center me-3 {{ $image->violence }}">
                                                                </div>
                                                                <div class="text-pr text-secondary">Violence</div>
                                                            </div>
                                                            <div
                                                                class="col-xl-2 col-4 d-flex justify-content-start align-items-center">
                                                                <div class="text-center me-3 {{ $image->spoof }}"></div>
                                                                <div class="text-pr text-secondary">Spoof</div>
                                                            </div>
                                                            <div
                                                                class="col-xl-2 col-4 d-flex justify-content-start align-items-center">
                                                                <div class="text-center me-3  {{ $image->racy }}">
                                                                </div>
                                                                <div class="text-pr text-secondary">Racy</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div thumbsSlider="" class="swiper mySwiper3">
                                <div class="swiper-wrapper">
                                    @foreach ($article_to_check->Images as $key => $image)
                                        <div class="swiper-slide">
                                            <img src="{{ $image->getUrl(300, 300) }}"
                                                alt="Immagine {{ $key + 1 }} dell'articolo {{ $article_to_check->title }}" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- SWIPER DB IMAGES --}}
                        @else
                            {{-- SWIPER DEFAULT IMAGES --}}
                            <div class="swiper mySwiper2">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="/media/placeholder-show/1.png" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="/media/placeholder-show/2.png" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="/media/placeholder-show/3.png" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="/media/placeholder-show/5.png" />
                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            <div thumbsSlider="" class="swiper mySwiper3">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="/media/placeholder-show/1.png" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="/media/placeholder-show/2.png" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="/media/placeholder-show/3.png" />
                                    </div>

                                    <div class="swiper-slide">
                                        <img src="/media/placeholder-show/5.png" />
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- SWIPER END DEFAULT IMAGES --}}
                    </div>
                    <div
                        class="col-12 col-md-4 d-flex flex-column align-items-start justify-content-center ps-lg-5 pt-3">
                        <h2 class="fw-semibold mb-3 product-title">{{ $article_to_check->title }}</h2>
                        <h3>Autore: {{ $article_to_check->user->name }}</h3>
                        <h4 class="fst-italic text-muted mb-3"># {{ __('ui.' . $article_to_check->category->name) }}
                        </h4>

                        <h3 class=" h1 fw-bold h2 mb-1">{{ $article_to_check->price }} €</h3>
                        <p class="text-muted mb-4">{{ __('ui.vat_included') }}</p>

                        <div
                            class="d-flex pb-4 justify-content-md-around w-100  flex-column flex-md-row text-center justify-content-center gap-3 ">
                            <form action="{{ route('reject', ['article' => $article_to_check]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-review-danger btn-lg  py-3 px-4 fw-bold text-wh"><i
                                        class="fa-solid fa-x text-wh "></i> {{ __('ui.reject') }} </button>
                            </form>
                            <form action="{{ route('accept', ['article' => $article_to_check]) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <button class="btn btn-review-success btn-lg py-3 px-5 fw-bold text-wh"><i
                                        class="fa-solid fa-check text-wh "></i> {{ __('ui.accept') }}</button>
                            </form>
                        </div>
                        @if (session('revisor_can_undo'))
                            <form action="{{ route('undo', ['article' => $article_to_check]) }}" method="POST"
                                class="w-100 ">
                                @csrf
                                @method('PATCH')

                                <button class="btn btn-buy btn-lg py-2 px-5 fw-bold text-white w-100 mt-5 border-0"><i
                                        class="fa-solid fa-x fa-arrow-rotate-left"></i></i>
                                    {{ __('ui.undo') }}</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-12 mt-5 d-none d-lg-block">

                        <x-desktop-accordion :article="$article_to_check"></x-desktop-accordion>
                    </div>
                    <div class="col-12 mt-5 d-lg-none">

                        <x-mobile-accordion :article="$article_to_check"></x-mobile-accordion>
                    </div>
                @else
                    <div class="row justify-content-center align-items-center ">
                        <div class="col 12">
                            <h2 class="text-secondary fw-semibold text-center mt-5">
                                {{ __('ui.no_articles_to_review') }}
                                .</h2>
                        </div>
                    </div>
        @endif
        </div>
    </main>
</x-layout>
