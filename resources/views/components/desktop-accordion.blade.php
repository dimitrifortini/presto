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
            <p class="text-pr ">{{ $article->description }}</p>

        </div>


        <div class="panel" id="information">
            <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto at quibusdam
                officia. Asperiores laudantium quaerat, deserunt quam, similique quibusdam animi ut amet
                nulla est modi repellat voluptatum pariatur labore quisquam?
            </p>

        </div>


        <div class="panel" id="information2">

            <button type="button" class="bg-wh border-0 fw-semibold add_review mb-4" data-bs-toggle="modal"
                data-bs-target="#reviewModal"><i class="fa-solid fa-plus"></i> Aggiungi una recensione</button>
            @foreach ($reviews as $review)
                <div>
                    <h6 class="fw-semibold">{{ $review->user->name }} <span>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <i class="fa-solid fa-star yellow_star"></i>
                                @else
                                    <i class="fa-regular fa-star"></i>
                                @endif
                            @endfor
                        </span>
                    </h6>
                    <p>{{$review->content}}</p>

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
                    <textarea class="bg-wh w-100" name="content" id="content"></textarea>

                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">

                <button form="reviewForm" type="submit" class="btn btn-submit ">Aggiungi</button>
            </div>
        </div>
    </div>
</div>
