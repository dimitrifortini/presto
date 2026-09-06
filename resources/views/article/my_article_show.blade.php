@section('navbar-class', 'navbar-bg')
<x-layout>
    <main class="container my-5">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="mb-5 fw-semibold">{{ __('ui.the status of the listing is') }} :
                    @switch($article->is_accepted)
                        @case(0)
                            <span class="text-warning">{{ __('ui.pending_review') }}</span>
                        @break

                        @case(1)
                            <span class="text-success"> {{ __('ui.accepted') }}</span>
                        @break
                    @endswitch

                </h2>
            </div>
            <div class="col-12 col-md-7 text-center">
                @if ($article->images->count())
                    {{-- SWIPER DB IMAGES --}}
                    <div class="swiper mySwiper2">
                        <div class="swiper-wrapper">
                            @foreach ($article->images as $key => $image)
                                <div class="swiper-slide swiper-slide-show">
                                    <img src="{{ $image->getUrl(300, 300) }}"
                                        alt="Immagine {{ $key + 1 }} dell'articolo {{ $article->title }}" />
                                </div>
                            @endforeach


                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper3">
                        <div class="swiper-wrapper">
                            @foreach ($article->images as $key => $image)
                                <div class="swiper-slide ">
                                    <img src="{{ $image->getUrl(300, 300) }}"
                                        alt="Immagine {{ $key + 1 }} dell'articolo {{ $article->title }}" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- SWIPER DB IMAGES --}}
                @else
                    {{-- SWIPER DEFAULT IMAGES --}}
                    <div class="swiper mySwiper2">
                        <div class="swiper-wrapper ">
                            <div class="swiper-slide swiper-slide-show">
                                <img src="/media/placeholder-show/1.png" />
                            </div>
                            <div class="swiper-slide swiper-slide-show">
                                <img src="/media/placeholder-show/2.png" />
                            </div>
                            <div class="swiper-slide swiper-slide-show">
                                <img src="/media/placeholder-show/3.png" />
                            </div>
                            <div class="swiper-slide swiper-slide-show">
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
                class="col-12 col-md-4 d-flex flex-column align-items-lg-start align-items-center justify-content-center mt-3 ps-lg-5  ">
                <h2 class="fw-semibold mb-2 product-title">{{ $article->title }}</h2>
                <p class="h4 text-secondary fst-italic mb-4">#{{ __('ui.' . $article->category->name) }}</p>
                <h3 class=" h1 fw-bold h2 mb-1">{{ $article->price }} €</h3>
                <p class="text-muted mb-5"> {{ __('ui.vat_included') }}</p>
                {{-- TRIGGER MODAL --}}
                <a class="w-100 text-white" href="{{route("article.edit",compact("article"))}}">
                    <button class="btn-buy btn w-100 mb-3" > {{ __('ui.edit') }}</button>
                </a>                
                <button type="button" class="mt-5 btn-buy btn-review-danger align-self-center" data-bs-toggle="modal" data-bs-target="#deleteModal"> {{ __('ui.delete') }}</button>
                
            </div>
            <div class="col-12 mt-5 d-none d-lg-block">

                <x-desktop-accordion :$article></x-desktop-accordion>
            </div>
            <div class="col-12 mt-5 d-lg-none">

                <x-mobile-accordion :$article></x-mobile-accordion>
            </div>


        </div>
    </main>
    {{-- MODAL --}}
    <div class="modal fade mt-200" id="deleteModal" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title fs-5" id="deleteLabel">{{ __('ui.delete_listing') }}</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h5 class="semibold text-center">{{ __('ui.are_you_sure_you_want_to_delete_this_listing') }}</h5>
            <p class="text-muted text-center">{{ __('ui.this_action_cannot_be_undone') }}</p>
          </div>
          <div class="modal-footer">
            <form action="{{route("article.delete",compact("article"))}}" method="POST" class="d-flex justify-content-center w-100">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class=" btn-buy btn-review-danger align-self-center" > {{ __('ui.delete') }}</button>
                    </form>
            
          </div>
        </div>
      </div>
    </div>
</x-layout>
