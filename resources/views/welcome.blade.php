@section('navbar-position', 'position-absolute')

<x-layout>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12 p-0">

                <header class="header w-100 position-relative">

                    <video src="/media/header.mp4"
                        autoplay
                        muted
                        loop
                        playsinline
                        aria-hidden="true"
                        class="img-fluid w-100 p-0">
                    </video>

                    <div class="position-absolute header-title-position w-100 d-none d-lg-block">

                        <h1 class="fw-bolder header-h1 text-wh ms-5">
                            {{ __('ui.hero_title') }}
                        </h1>

                        <p class="fst-italic fw-semibold text-wh mb-xl-5 ms-5 header-h3">
                            {{ __('ui.hero_subtitle') }}
                        </p>

                        <div class="d-flex justify-content-center ">

                            <a href="{{ route('article.index') }}"
                                class="text-decoration-none text-blk mt-xl-3 mt-3 fw-bolder h3 btn-header text-center mb-3 pt-4 shadow ">

                                {{ __('ui.start_now') }}

                                <span class="d-block text-center fw-semibold text-pr ">
                                    Presto.it
                                </span>

                            </a>

                        </div>

                    </div>

                </header>

            </div>


            @if (session()->has('errorMessage'))

                <div class="row justify-content-center m-0">

                    <div class="w-100 alert alert-danger text-center shadow rounded"
                        id="errorMessage">

                        {{ session('errorMessage') }}

                    </div>

                </div>

            @endif


            @if (session()->has('message'))

                <div class="row justify-content-center">

                    <div class="w-100 alert alert-success text-center shadow rounded"
                        id="message">

                        {{ session('message') }}

                    </div>

                </div>

            @endif


            <div class="col-12 mt-5 ps-5">

                <h2 class="fw-semibold ls-2">
                    {{ __('ui.recent_articles') }}
                </h2>

            </div>


            <div class="col-12 p-0">

                {{-- SWIPER HOMEPAGE --}}

                <div class="swiper mySwiper py-lg-5 py-5">

                    <div class="swiper-wrapper">

                        @forelse ($articles as $article)

                            <div class="swiper-slide bg-transparent">

                                <x-card :$article></x-card>

                            </div>

                        @empty

                            <div class="w-100 text-center bg-transparent">

                                <p class="w-100 text-secondary fw-semibold">
                                    {{ __('ui.no_articles_available') }}
                                </p>

                            </div>

                        @endforelse

                    </div>

                </div>

                {{-- SWIPER HOMEPAGE END --}}

            </div>

        </div>

    </div>

</x-layout>