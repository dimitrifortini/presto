
<section class="product-info">
    @if (session('reviewMessage'))
    <div class="alert alert-success text-center mt-5" role="alert">
        {{ session('reviewMessage') }}
    </div>
    @endif
    <div class="accordion-tabs ">
        <button class="accordion-tab active" data-tab="description">
            {{ __('ui.description') }}
        </button>
        @if (!request()->routeIs('revisor.index'))
            <button class="accordion-tab" data-tab="information2">
                {{ __('ui.reviews') }}
            </button>
        @endif
    </div>
    <div class="accordion-content">
        <div class="panel active" id="description">
            <p class="text-pr ">{{ $article->description }}</p>
        </div>
        @if (!request()->routeIs('revisor.index'))
            <div class="panel " id="information2">
                @auth
                    <button type="button" class="bg-transparent border-0 fw-semibold add_review mb-5 h4"
                        data-bs-toggle="modal" data-bs-target="#reviewModal"><i class="fa-solid fa-plus"></i>
                        {{ __('ui.add_review') }}</button>

                @endauth
                @foreach ($reviews as $review)
                    <div class="review-card border px-5 pt-4 mb-3 rounded-1 shadow bg-wh">

                        <h3 class="fw-bold d-flex justify-content-start">
                            {{ $review->user?->name ?? $review->reviewer_name }}

                            <span class="ms-4">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <i class="fa-solid fa-star yellow_star"></i>
                                    @else
                                        <i class="fa-regular fa-star"></i>
                                    @endif
                                @endfor
                            </span>

                            @if ($review->user && auth()->id() == $review->user->id)
                                <div class="ms-auto d-flex gap-2">
                                    <button type="button" class="edit-review border-0 bg-transparent">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button type="button" class="delete-review border-0 bg-transparent"
                                        data-delete-url="{{ route('review.destroy', $review) }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <button type="button" class="cancel-review border-0 bg-transparent d-none">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                            @endif
                        </h3>

                        <div class="review-display">
                            <p class="mt-4 fs-5 review-text">
                                {{ $review->content }}
                            </p>

                        </div>
                        {{-- UPDATE FORM --}}
                        @if (
                            ($review->user && auth()->id() == $review->user->id) ||
                                (auth()->check() && (auth()->user()->isRevisor || auth()->user()->isAdmin)))
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
                                            {{ __('ui.edit_rating') }}
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
                                            {{ __('ui.edit') }}
                                        </button>
                                    </div>                                   
                                </form>
                            </div>
                        @endif
                        <p class="text-muted fs-6 text-end">
                            {{ __('ui.added_on') }} {{ $review->updated_at->translatedFormat('d F Y') }}
                        </p>
                    </div>
                @endforeach

            </div>
        @endif

    </div>

</section>
{{-- REVIEW MODAL --}}
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reivewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-wh text-blk">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="reivewModalLabel">{{ __('ui.add_new_review') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('review.store', compact('article')) }}" method="POST" id="reviewForm">
                    @csrf
                    <div class="rating mt-3 mb-5">
                        <h5 class="mb-3">{{ __('ui.rating') }}::</h5>
                        <i class="fa-regular fa-star" data-rating="1"></i>
                        <i class="fa-regular fa-star" data-rating="2"></i>
                        <i class="fa-regular fa-star" data-rating="3"></i>
                        <i class="fa-regular fa-star" data-rating="4"></i>
                        <i class="fa-regular fa-star" data-rating="5"></i>
                        <input type="hidden" name="rating" id="rating">
                    </div>
                    <label class="h5" for="content">{{ __('ui.write_review') }}:</label>
                    <textarea class="bg-wh w-100 px-3 py-2" name="content" id="content"></textarea>

                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">

                <button form="reviewForm" type="submit" class="btn btn-submit ">{{ __('ui.add') }}</button>
            </div>
        </div>
    </div>
</div>
{{-- Pop up delete --}}
<div id="deletePopup" class="delete-popup d-none ">

    <div class="delete-popup-content shadow">

        <p class="mb-4">
            {{ __('ui.delete_review_confirm') }}
        </p>

        <div class="d-flex justify-content-end gap-2">

            <button type="button" id="cancelDelete" class="btn btn-secondary">
                {{ __('ui.cancel') }}
            </button>

            <form id="deleteReviewForm" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    {{ __('ui.delete') }}
                </button>
            </form>

        </div>

    </div>

</div>
