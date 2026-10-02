<section class="mobile-accordion d-lg-none m-show-tablet">

    @if (session('reviewMessage'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('reviewMessage') }}
        </div>
    @endif

    <div class="mobile-item active">

        <button class="mobile-header">
            <span>{{ __('ui.description') }}</span>
            <span class="mobile-icon">+</span>
        </button>

        <div class="mobile-body">
            <p>{{ $article->description }}</p>
        </div>

    </div>
    @if (!request()->routeIs('revisor.index'))

        <div class="mobile-item">

            <button class="mobile-header">
                <span>{{ __('ui.reviews') }}</span>
                <span class="mobile-icon">+</span>
            </button>

            <div class="mobile-body">
                @auth
                    <button type="button" class="bg-wh border-0 fw-semibold add_review mb-4" data-bs-toggle="modal"
                        data-bs-target="#reviewMobileModal">

                        <i class="fa-solid fa-plus"></i>
                        {{ __('ui.add_review') }}

                    </button>
                @endauth


                @foreach ($reviews as $review)
                    <div class="review-card border ps-3  pe-1 py-3 mb-3 rounded-1 shadow bg-wh">


                        <div class="d-flex align-items-center">

                            <h5 class="fw-bold mb-0">
                                {{ $review->user?->name ?? $review->reviewer_name }}
                            </h5>

                            <span class="ms-3">

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <i class="fa-solid fa-star yellow_star"></i>
                                    @else
                                        <i class="fa-regular fa-star"></i>
                                    @endif
                                @endfor

                            </span>



                            @if ($review->user && auth()->id() == $review->user->id)
                                <div class="ms-auto d-flex ">

                                    <button type="button" class="edit-review border-0 bg-transparent">

                                        <i class="fa-solid fa-pencil"></i>

                                    </button>


                                    <button type="button" class="delete-review border-0 bg-transparent "
                                        data-delete-url="{{ route('review.destroy', $review) }}">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>


                                    <button type="button" class="cancel-review border-0 bg-transparent d-none">

                                        <i class="fa-solid fa-xmark"></i>

                                    </button>

                                </div>
                            @endif

                        </div>

                        <div class="review-display">

                            <p class="mt-3 mb-0 review-text ps-1 pe-3 ">
                                {{ $review->content }}
                            </p>

                        </div>

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

                                        <label class="mb-2">
                                            {{ __('ui.edit_rating') }}
                                        </label>

                                        <div class="rating mb-3">

                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fa-star
                                                {{ $i <= $review->rating ? 'fa-solid yellow_star' : 'fa-regular' }}"
                                                    data-rating="{{ $i }}">
                                                </i>
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


                        <p class="text-muted text-center fs-6 text-end mt-3 mb-0">
                            {{ __('ui.added_on') }} {{ $review->updated_at->translatedFormat('d F Y') }}
                        </p>

                    </div>
                @endforeach

            </div>
    @endif

    </div>

</section>
{{-- DELETE POPUP MOBILE --}}
<div id="deletePopupMobile" class="delete-popup d-none">

    <div class="delete-popup-content shadow">

        <p class="mb-4">
            {{ __('ui.delete_review_confirm') }}
        </p>

        <div class="d-flex justify-content-end gap-2">

            <button type="button" id="cancelDeleteMobile" class="btn btn-secondary">
                {{ __('ui.cancel') }}
            </button>

            <form id="deleteReviewFormMobile" method="POST">

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    {{ __('ui.delete') }}
                </button>

            </form>

        </div>

    </div>

</div>

{{-- REVIEW MODAL --}}
<div class="modal fade" id="reviewMobileModal" tabindex="-1" aria-labelledby="reivewModalMobileLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-wh text-blk">
            <div class="modal-header">
                <h2 class="modal-title  fs-5 h1" id="reivewModalMobileLabel">{{ __('ui.add_new_review') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('review.store', compact('article')) }}" method="POST" id="reviewFormMobile">
                    @csrf
                    <div class="rating mt-3 mb-5">
                        <h5 class="mb-3">{{ __('ui.rating') }}:</h5>
                        <i class="fa-regular fa-star" data-rating="1"></i>
                        <i class="fa-regular fa-star" data-rating="2"></i>
                        <i class="fa-regular fa-star" data-rating="3"></i>
                        <i class="fa-regular fa-star" data-rating="4"></i>
                        <i class="fa-regular fa-star" data-rating="5"></i>
                        <input type="hidden" name="rating" id="ratingMobile">
                    </div>
                    <label class="h5" for="contentMobile">{{ __('ui.write_review') }}:</label>
                    <textarea class="bg-wh w-100 px-3 py-2" name="content" id="contentMobile"></textarea>

                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">

                <button form="reviewFormMobile" type="submit" class="btn btn-submit ">{{ __('ui.add') }}</button>
            </div>
        </div>
    </div>
</div>
