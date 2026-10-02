@section('navbar-position', 'position-absolute')

<x-layout>

    <div class="container-fluid p-0">
        <div class="row mx-0">
            <div class="col-12 p-0">

                <header class="bg-category d-flex align-items-end">
                    <h1 class="fw-bold text-wh category-title pb-2 ps-4 display-4">
                        {{ __('ui.your_reviews') }}
                    </h1>
                </header>

            </div>
        </div>
    </div>


    @if ($reviews->isNotEmpty())

        <main class="container my-5">

            <div class="row g-4">

                @foreach ($reviews as $review)
                    <div class="col-12">

                        <div class="review-card border px-5 pt-4 rounded-1 shadow bg-wh">

                            <div class="d-flex align-items-center">

                                <div>

                                    <h2 class="fw-bold mb-1">
                                        {{ $review->article?->title ?? __('ui.article_unavailable') }}
                                    </h2>

                                    <small class="text-secondary">
                                        {{ __('ui.reviewed_on') }}
                                        <time datetime="{{ $review->updated_at->toISOString() }}">
                                            {{ $review->updated_at->translatedFormat('d F Y') }}
                                        </time>
                                    </small>

                                </div>


                                @if ($review->reviewer_id === auth()->id())
                                    <div class="ms-auto d-flex gap-2">

                                        @if ($review->article)
                                            <button type="button"
                                                class="edit-review border-0 bg-transparent"
                                                aria-label="{{ __('ui.edit') }}">
                                                <i class="fa-solid fa-pencil" aria-hidden="true"></i>
                                            </button>
                                        @endif

                                        <button type="button"
                                            class="delete-review border-0 bg-transparent"
                                            data-delete-url="{{ route('review.destroy', $review) }}"
                                            aria-label="{{ __('ui.delete') }}">
                                            <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                        </button>

                                        <button type="button"
                                            class="cancel-review border-0 bg-transparent d-none"
                                            aria-label="{{ __('ui.cancel') }}">
                                            <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                                        </button>

                                    </div>
                                @endif

                            </div>

                            <div class="review-display">

                                <div class="row align-items-center mt-4">

                                    <div class="col-md-3">

                                        <div class="mb-2 text-secondary small">
                                            {{ __('ui.rating') }}
                                        </div>

                                        <div class="d-flex gap-1">

                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class="fa-solid fa-star yellow_star"
                                                        aria-hidden="true"></i>
                                                @else
                                                    <i class="fa-regular fa-star text-muted"
                                                        aria-hidden="true"></i>
                                                @endif
                                            @endfor

                                        </div>

                                    </div>


                                    <div class="col-md-9">

                                        <div class="mb-2 text-secondary small">
                                            {{ __('ui.your_review') }}
                                        </div>

                                        <p class="mb-0 fs-5 review-text">
                                            {{ $review->content }}
                                        </p>

                                    </div>

                                </div>

                            </div>


                            @if ($review->article)
                                <div class="review-edit d-none">

                                    <form
                                        action="{{ route('review.update', [
                                            'article' => $review->article,
                                            'review' => $review,
                                        ]) }}"
                                        method="POST">

                                        @csrf
                                        @method('PUT')


                                        <label for="review-content-{{ $review->id }}" class="visually-hidden">
                                            {{ __('ui.your_review') }}
                                        </label>

                                        <textarea
                                            id="review-content-{{ $review->id }}"
                                            name="content"
                                            class="bg-wh w-100 px-3 py-3 mt-3 rounded-1"
                                            rows="5">{{ $review->content }}</textarea>


                                        <div class="mt-3">

                                            <label for="rating-{{ $review->id }}" class="mb-3">
                                                {{ __('ui.edit_rating') }}
                                            </label>

                                            <div class="rating mb-3">

                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fa-star {{ $i <= $review->rating ? 'fa-solid yellow_star' : 'fa-regular' }}"
                                                        data-rating="{{ $i }}"
                                                        aria-hidden="true"></i>
                                                @endfor

                                                <input
                                                    type="hidden"
                                                    id="rating-{{ $review->id }}"
                                                    name="rating"
                                                    value="{{ $review->rating }}">

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


                            <p class="text-muted fs-6 text-end mt-3 mb-3">
                                {{ __('ui.updated_on') }}
                                <time datetime="{{ $review->updated_at->toISOString() }}">
                                    {{ $review->updated_at->translatedFormat('d F Y') }}
                                </time>
                            </p>

                        </div>

                    </div>
                @endforeach

            </div>

        </main>

    @else

        <main class="container">

            <h2 class="h1 text-center fw-bold my-5">
                {{ __('ui.no_reviews') }}
            </h2>

        </main>

    @endif


    {{-- DELETE POPUP --}}

    <div id="deletePopupProfile" class="delete-popup d-none">

        <div class="delete-popup-content shadow">

            <p class="mb-4">
                {{ __('ui.delete_review_confirm') }}
            </p>

            <div class="d-flex justify-content-end gap-2">

                <button type="button"
                    id="cancelDeleteProfile"
                    class="btn btn-secondary">
                    {{ __('ui.cancel') }}
                </button>


                <form id="deleteReviewFormProfile" method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        {{ __('ui.delete') }}
                    </button>

                </form>

            </div>

        </div>

    </div>

</x-layout>
