@if (session('message'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('message') }}
    </div>
@endif
<section class="product-info">

    <div class="accordion-tabs">

        <button class="accordion-tab active" data-tab="description">
            {{ __('ui.description') }}
        </button>

        <button class="accordion-tab" data-tab="information">
            {{ __('ui.information') }}
        </button>

        <button class="accordion-tab" data-tab="information2">
            Recensioni
        </button>

    </div>


    <div class="accordion-content">

        <div class="panel active" id="description">
            <p class="text-pr ">{{ $article->description }}Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                Architecto at quibusdam
                officia. Asperiores laudantium quaerat, deserunt quam, similique quibusdam animi ut amet
                nulla est modi repellat voluptatum pariatur labore quisquam?</p>

        </div>


        <div class="panel" id="information">
            <p class="fs-5">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto at quibusdam
                officia. Asperiores laudantium quaerat, deserunt quam, similique quibusdam animi ut amet
                nulla est modi repellat voluptatum pariatur labore quisquam?Lorem ipsum dolor sit, amet consectetur
                adipisicing elit. Architecto at quibusdam
                officia. Asperiores laudantium quaerat, deserunt quam, similique quibusdam animi ut amet
                nulla est modi repellat voluptatum pariatur labore quisquam?Lorem ipsum dolor sit, amet consectetur
                adipisicing elit. Architecto at quibusdam
                officia. Asperiores laudantium quaerat, deserunt quam, similique quibusdam animi ut amet
                nulla est modi repellat voluptatum pariatur labore quisquam?Lorem ipsum dolor sit, amet consectetur
                adipisicing elit. Architecto at quibusdam
                officia. Asperiores laudantium quaerat, deserunt quam, similique quibusdam animi ut amet
                nulla est modi repellat voluptatum pariatur labore quisquam?Lorem ipsum dolor sit, amet consectetur
                adipisicing elit. Architecto at quibusdam
                officia. Asperiores laudantium quaerat, deserunt quam, similique quibusdam animi ut amet
                nulla est modi repellat voluptatum pariatur labore quisquam?Lorem ipsum dolor sit, amet consectetur
                adipisicing elit. Architecto at quibusdam
                officia. Asperiores laudantium quaerat, deserunt quam, similique quibusdam animi ut amet
                nulla est modi repellat voluptatum pariatur labore quisquam?
            </p>

        </div>


        <div class="panel " id="information2">

            <button type="button" class="bg-wh border-0 fw-semibold add_review mb-5 h4" data-bs-toggle="modal"
                data-bs-target="#reviewModal"><i class="fa-solid fa-plus"></i> Aggiungi una recensione</button>
            @foreach ($reviews as $review)
                <div class="review-card border px-5 pt-4 mb-3 rounded-1 shadow bg-wh">

                    <h3 class="fw-bold d-flex justify-content-start">
                        {{ $review->user->name }}

                        <span class="ms-4">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <i class="fa-solid fa-star yellow_star"></i>
                                @else
                                    <i class="fa-regular fa-star"></i>
                                @endif
                            @endfor
                        </span>

                        @if (auth()->id() == $review->user->id)
                            <div class="ms-auto d-flex gap-2">

                                {{-- MATITA --}}
                                <button type="button" class="edit-review border-0 bg-transparent">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>

                                {{-- CESTINO --}}
                                <button type="button" class="delete-review border-0 bg-transparent"
                                    data-delete-url="{{ route('review.destroy', $review) }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                {{-- X --}}
                                <button type="button" class="cancel-review border-0 bg-transparent d-none">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>

                            </div>
                        @endif
                    </h3>


                    {{-- TESTO NORMALE --}}
                    <div class="review-display">
                        <p class="mt-4 fs-5 review-text">
                            {{ $review->content }} Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio quam
                            amet tempore harum enim at quia sit aliquid facere in nulla quod consequatur illo, libero
                            debitis soluta minima ab dolorem?
                        </p>

                    </div>


                    {{-- FORM DI MODIFICA --}}
                    @if (auth()->id() == $review->user->id)
                        <div class="review-edit d-none">

                            <form
                                action="{{ route('review.update', [
                                    'article' => $article,
                                    'review' => $review,
                                ]) }}"
                                method="POST">

                                @csrf
                                @method('PUT')

                                <textarea name="content" class="bg-wh w-100 px-3 py-3 mt-3 rounded-1" rows="5">{{ $review->content }}</textarea>

                                <div class="mt-3">

                                    <label class="mb-3" for="rating-{{ $review->id }}">
                                        Modifica valutazione
                                    </label>

                                    <div class="rating mb-3">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa-star {{ $i <= $review->rating ? 'fa-solid yellow_star' : 'fa-regular' }}"
                                                data-rating="{{ $i }}"></i>
                                        @endfor

                                        <input type="hidden" name="rating" value="{{ $review->rating }}">
                                    </div>

                                </div>

                                <div class="mt-3 d-flex justify-content-center">

                                    <button type="submit" class="btn btn-submit">
                                        Modifica
                                    </button>



                                </div>

                            </form>

                        </div>
                    @endif


                    <p class="text-muted fs-6 text-end">
                        Aggiunto il {{ $review->updated_at }}
                    </p>

                </div>
            @endforeach

        </div>

    </div>

</section>
{{-- REVIEW MODAL --}}
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reivewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-wh text-blk">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="reivewModalLabel">Aggiungi una nuova recensione</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('review.store', compact('article')) }}" method="POST" id="reviewForm">
                    @csrf
                    <div class="rating mt-3 mb-5">
                        <h5 class="mb-3">Valutazione:</h5>
                        <i class="fa-regular fa-star" data-rating="1"></i>
                        <i class="fa-regular fa-star" data-rating="2"></i>
                        <i class="fa-regular fa-star" data-rating="3"></i>
                        <i class="fa-regular fa-star" data-rating="4"></i>
                        <i class="fa-regular fa-star" data-rating="5"></i>
                        <input type="hidden" name="rating" id="rating">
                    </div>
                    <label class="h5" for="content">Scrivi la tua recensione:</label>
                    <textarea class="bg-wh w-100 px-3 py-2" name="content" id="content"></textarea>

                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">

                <button form="reviewForm" type="submit" class="btn btn-submit ">Aggiungi</button>
            </div>
        </div>
    </div>
</div>
{{-- Pop up delete --}}
<div id="deletePopup" class="delete-popup d-none ">

    <div class="delete-popup-content shadow">

        <p class="mb-4">
            Sei sicuro di voler eliminare questa recensione?
        </p>

        <div class="d-flex justify-content-end gap-2">

            <button type="button" id="cancelDelete" class="btn btn-secondary">
                Annulla
            </button>

            <form id="deleteReviewForm" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    Elimina
                </button>
            </form>

        </div>

    </div>

</div>
