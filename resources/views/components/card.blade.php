<article class="bg-wh shadow card-custom">
    <a class="card-link"
        href="
    @if (request()->routeIs('article.my_article')) {{ route('article.my_article_show', compact('article')) }}
    @else
    {{ route('article.show', compact('article')) }} @endif">

        @if ($article->thumbnail)
            <div class="overflow-hidden card-container">
                <img src="{{ $article->thumbnail }}" alt="Immagine {{ $article->title }}" class="card-img mb-4">
            </div>
        @elseif ($article->images->isNotEmpty())
            <div class="overflow-hidden card-container">
                <img src="{{ $article->images->first()->getUrl(300, 300) }}" alt="Immagine {{ $article->title }}"
                    class="card-img mb-4">
            </div>
        @else
            <div class="overflow-hidden card-container">
                <img src="/media/product.png" alt="Immagine di un paio di cuffie" class="card-img mb-4">
            </div>
        @endif

        <div class="text-center mt-3  ">
            <h2 class="fw-bold mb-3 title-card">{{ Str::limit($article->title, 20) }}</h2>

            <p class="mb-5 py-2 px-3 text-pr text-secondary">
                #{{ __('ui.' . $article->category->name) }}
            </p>

            <p class="mb-3 fw-semibold h3">
                {{ $article->price }}€
            </p>
        </div>
    </a>

    <form method="POST" action="{{ route('cart.store', ['article' => $article]) }}" class="text-center pb-4">
        @csrf
        <input type="hidden" name="quantity" value="1">
        <button type="submit" class="btn-buy">
            {{ __('ui.add_to_cart') }}
        </button>
    </form>
</article>
