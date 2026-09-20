@section('navbar-position', 'position-absolute')

<x-layout>

    <div class="container-fluid p-0">
        <div class="row mx-0">
            <div class="col-12 p-0">

                <header class="bg-category d-flex align-items-end">
                    <h1 class="fw-bold text-wh category-title pb-2 ps-4 display-4">
                        Le tue recensioni
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

                            {{-- HEADER --}}
                            <div class="d-flex align-items-center">

                                <div>

                                    <h3 class="fw-bold mb-1">
                                        {{ $review->article?->title ?? 'Articolo non più disponibile' }}
                                    </h3>

                                    <small class="text-secondary">
                                        Recensito il
                                        {{ $review->updated_at->translatedFormat('d F Y') }}
                                    </small>

                                </div>


                                {{-- AZIONI --}}
                                @if ($review->reviewer_id === auth()->id())
                                    <div class="ms-auto d-flex gap-2">

                                        {{-- MATITA --}}
                                        @if ($review->article)
                                            <button type="button" class="edit-review border-0 bg-transparent">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                        @endif


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

                            </div>


                            {{-- VISUALIZZAZIONE --}}
                            <div class="review-display">

                                <div class="row align-items-center mt-4">

                                    {{-- RATING --}}
                                    <div class="col-md-3">

                                        <div class="mb-2 text-secondary small">
                                            Valutazione
                                        </div>

                                        <div class="d-flex gap-1">

                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class="fa-solid fa-star yellow_star"></i>
                                                @else
                                                    <i class="fa-regular fa-star text-muted"></i>
                                                @endif
                                            @endfor

                                        </div>

                                    </div>


                                    {{-- RECENSIONE --}}
                                    <div class="col-md-9">

                                        <div class="mb-2 text-secondary small">
                                            La tua recensione
                                        </div>

                                        <p class="mb-0 fs-5 review-text">
                                            {{ $review->content }}
                                        </p>

                                    </div>

                                </div>

                            </div>


                            {{-- MODIFICA --}}
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


                                        <textarea name="content" class="bg-wh w-100 px-3 py-3 mt-3 rounded-1" rows="5">{{ $review->content }}</textarea>


                                        <div class="mt-3">

                                            <label class="mb-3">
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


                            {{-- DATA --}}
                            <p class="text-muted fs-6 text-end mt-3 mb-3">
                                Aggiornato il {{ $review->updated_at->translatedFormat('d F Y') }}
                            </p>

                        </div>

                    </div>
                @endforeach

            </div>

        </main>
    @else
        <main class="container">

            <h2 class="h1 text-center fw-bold my-5">
                Non hai ancora scritto recensioni.
            </h2>

        </main>

    @endif


    {{-- DELETE POPUP --}}

    <div id="deletePopupProfile" class="delete-popup d-none">

        <div class="delete-popup-content shadow">

            <p class="mb-4">
                Sei sicuro di voler eliminare questa recensione?
            </p>

            <div class="d-flex justify-content-end gap-2">

                <button type="button" id="cancelDeleteProfile" class="btn btn-secondary">
                    Annulla
                </button>


                <form id="deleteReviewFormProfile" method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Elimina
                    </button>

                </form>

            </div>

        </div>

    </div>

</x-layout>
