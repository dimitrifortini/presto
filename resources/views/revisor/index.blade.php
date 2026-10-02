@section('navbar-position', 'position-absolute')

<x-layout>

    <main>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 bg-category d-flex align-items-end">
                    <h1 class="fw-bold title-category display-4 text-wh ps-3 pb-2">
                        {{ __('ui.revisor_dashboard') }}
                    </h1>
                </div>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="row justify-content-center">
                <div class="col-12 alert alert-success text-center shadow rounded">
                    {{ session('message') }}
                </div>
            </div>
        @elseif (session()->has('error_message'))
            <div class="row justify-content-center">
                <div class="col-12 alert alert-danger text-center shadow rounded">
                    {{ session('error_message') }}
                </div>
            </div>
        @endif

        @if ($article_to_check)

            {{-- Modal --}}
            <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">

                <div class="modal-dialog">

                    <div class="modal-content bg-wh">

                        <div class="modal-header">

                            <h2 class="modal-title fs-5" id="rejectModalLabel">
                                {{ __('ui.reject_article') }}
                            </h2>

                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="{{ __('ui.close') }}"></button>

                        </div>

                        <div class="modal-body">

                            <form action="{{ route('reject', ['article' => $article_to_check->id]) }}" method="POST"
                                class="w-100" id="rejectForm">

                                @csrf

                                <label for="rejectReason" class="visually-hidden">
                                    {{ __('ui.rejection_reason') }}
                                </label>

                                <textarea name="reason" id="rejectReason" rows="10" class="bg-transparent w-100"
                                    placeholder="{{ __('ui.rejection_reason_placeholder') }}"></textarea>

                                @method('PATCH')

                            </form>

                        </div>

                        <div class="modal-footer">

                            <button type="submit" class="btn btn-review-danger  py-3 px-4 fw-bold text-wh w-100"
                                form="rejectForm">

                                <i class="fa-solid fa-x text-wh" aria-hidden="true"></i>
                                {{ __('ui.reject') }}

                            </button>

                        </div>

                    </div>

                </div>

            </div>


            <div class="container my-5">

                <div class="row">

                    <div class="col-12 col-md-7 text-center mb-5">

                        @if ($article_to_check->images->count())

                            {{-- SWIPER DB IMAGES --}}

                            <div class="swiper mySwiper2">

                                <div class="swiper-wrapper">

                                    @foreach ($article_to_check->images as $key => $image)
                                        <div class="swiper-slide bg-transparent">

                                            <div class="row mx-0">

                                                <div class="col-12 swiper-slide-image">

                                                    <img src="{{ $image->getUrl(300, 300) }}"
                                                        alt="{{ __('ui.article_image', ['number' => $key + 1, 'title' => $article_to_check->title]) }}" />

                                                </div>

                                                <div class="col-12 swiper-slide-text">

                                                    <div class="col-12 mt-3">

                                                        <h3 class="fw-semibold">
                                                            {{ __('ui.labels') }}:
                                                        </h3>

                                                        @if ($image->labels)
                                                            @foreach ($image->labels as $label)
                                                                <span class="fst-italic text-secondary">
                                                                    #{{ $label }}
                                                                </span>
                                                            @endforeach
                                                        @else
                                                            <p class="fst-italic">
                                                                {{ __('ui.no_labels') }}
                                                            </p>
                                                        @endif

                                                    </div>

                                                    <h3 class="col-12 mt-3 fw-semibold">
                                                        {{ __('ui.ratings') }}:
                                                    </h3>

                                                    <div class="col-12">

                                                        <div class="row justify-content-center ">

                                                            <div
                                                                class="col-xl-3 col-12 d-flex justify-content-center align-items-center">

                                                                <div class="text-center me-3 {{ $image->adult }}">
                                                                </div>

                                                                <div class="text-pr text-secondary">
                                                                    {{ __('ui.adult') }}
                                                                </div>

                                                            </div>

                                                            <div
                                                                class="col-xl-4 col-12 d-flex  justify-content-center align-items-center">

                                                                <div class="text-center me-3 {{ $image->medical }}">
                                                                </div>

                                                                <div class="text-pr text-secondary">
                                                                    {{ __('ui.medical') }}
                                                                </div>

                                                            </div>

                                                            <div
                                                                class="col-xl-4 col-12 d-flex justify-content-center align-items-center">

                                                                <div class="text-center me-3 {{ $image->violence }}">
                                                                </div>

                                                                <div class="text-pr text-secondary">
                                                                    {{ __('ui.violence') }}
                                                                </div>

                                                            </div>

                                                            <div
                                                                class="col-xl-4 col-12 d-flex justify-content-center align-items-center">

                                                                <div class="text-center me-3 {{ $image->spoof }}">
                                                                </div>

                                                                <div class="text-pr text-secondary">
                                                                    {{ __('ui.spoof') }}
                                                                </div>

                                                            </div>

                                                            <div
                                                                class="col-xl-4  col-12 d-flex justify-content-center  align-items-center">

                                                                <div class="text-center me-3 {{ $image->racy }}">
                                                                </div>

                                                                <div class="text-pr text-secondary">
                                                                    {{ __('ui.racy') }}
                                                                </div>

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
                                        <div class="swiper-slide swiper-slide-show bg-transparent">

                                            <img src="{{ $image->getUrl(300, 300) }}" alt=""
                                                aria-hidden="true" />

                                        </div>
                                    @endforeach

                                </div>

                            </div>

                            {{-- SWIPER DB IMAGES  END --}}
                        @else
                            {{-- SWIPER DEFAULT IMAGES --}}

                            <div class="swiper mySwiper2">

                                <div class="swiper-wrapper">

                                    <div class="swiper-slide swiper-slide-show">
                                        <img src="/media/placeholder-show/1.png" alt="" />
                                    </div>

                                    <div class="swiper-slide swiper-slide-show">
                                        <img src="/media/placeholder-show/2.png" alt="" />
                                    </div>

                                    <div class="swiper-slide swiper-slide-show">
                                        <img src="/media/placeholder-show/3.png" alt="" />
                                    </div>

                                    <div class="swiper-slide swiper-slide-show">
                                        <img src="/media/placeholder-show/5.png" alt="" />
                                    </div>

                                </div>

                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>

                            </div>


                            <div thumbsSlider="" class="swiper mySwiper3">

                                <div class="swiper-wrapper">

                                    <div class="swiper-slide">
                                        <img src="/media/placeholder-show/1.png" alt="" aria-hidden="true" />
                                    </div>

                                    <div class="swiper-slide">
                                        <img src="/media/placeholder-show/2.png" alt="" aria-hidden="true" />
                                    </div>

                                    <div class="swiper-slide">
                                        <img src="/media/placeholder-show/3.png" alt="" aria-hidden="true" />
                                    </div>

                                    <div class="swiper-slide">
                                        <img src="/media/placeholder-show/5.png" alt="" aria-hidden="true" />
                                    </div>

                                </div>

                            </div>

                        @endif

                        {{-- SWIPER  DEFAULT IMAGES END --}}

                    </div>


                    <div
                        class="col-12 col-md-4 d-flex flex-column align-items-start justify-content-center ps-lg-5 pt-3 m-revisor-mobile">

                        <h2 class="fw-semibold mb-3 product-title">
                            {{ $article_to_check->title }}
                        </h2>

                        <p class="mb-2">
                            {{ __('ui.author') }}:
                            <strong>{{ $article_to_check->user->name }}</strong>
                        </p>

                        <p class="fst-italic text-muted mb-3">
                            # {{ __('ui.' . $article_to_check->category->name) }}
                        </p>

                        <h3 class="fw-bold h2 mb-1">
                            {{ $article_to_check->price }} €
                        </h3>

                        <p class="text-muted mb-4">
                            {{ __('ui.vat_included') }}
                        </p>


                        <div class="d-flex pb-4 justify-content-md-around w-100 flex-column flex-md-row text-center justify-content-center gap-3">

                            <button type="button" class="btn btn-review-danger  py-3 px-4 fw-bold text-wh"
                                data-bs-toggle="modal" data-bs-target="#rejectModal">

                                <i class="fa-solid fa-x text-wh" aria-hidden="true"></i>
                                {{ __('ui.reject') }}

                            </button>


                            <form action="{{ route('accept', ['article' => $article_to_check]) }}" method="POST">

                                @csrf
                                @method('PATCH')

                                <button type="submit" class="btn btn-review-success w-100 py-3 px-5 fw-bold text-wh">

                                    <i class="fa-solid fa-check text-wh" aria-hidden="true"></i>
                                    {{ __('ui.accept') }}

                                </button>

                            </form>

                        </div>


                        @if (session('revisor_can_undo'))
                            <form action="{{ route('undo', ['article' => $article_to_check]) }}" method="POST"
                                class="w-100 ">

                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                    class="btn btn-buy btn-lg py-2 px-5 fw-bold text-white w-100 mt-5 border-0 ">

                                    <i class="fa-solid fa-arrow-rotate-left" aria-hidden="true"></i>
                                    {{ __('ui.undo') }}

                                </button>

                            </form>
                        @endif

                    </div>


                    <div class="col-12 mt-5 d-none d-lg-block">

                        <x-desktop-accordion  :article="$article_to_check" :reviews="$reviews">
                        </x-desktop-accordion>

                    </div>


                    <div class="col-12 mt-lg-5 m-revisor-tablet d-lg-none">

                        <x-mobile-accordion :article="$article_to_check" :reviews="$reviews">
                        </x-mobile-accordion>

                    </div>

                </div>

            </div>
        @else
            <div class="row justify-content-center align-items-center">

                <div class="col-12">

                    <h2 class="text-secondary fw-semibold text-center mt-5">
                        {{ __('ui.no_articles_to_review') }}
                    </h2>

                </div>

            </div>

        @endif

    </main>

</x-layout>
