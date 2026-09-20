@section('navbar-class', 'navbar-bg')
<x-layout>
    <main class="container-fluid">
        <div class="row justify-content-center">
            @forelse ($articles as $article)
                <div class="col-12 col-lg-3 col-md-6 my-5 mx-3">
                    <x-card :$article></x-card>
                </div>

            @empty
                <div class="col-12 mt-5">
                    <h3 class="text-center text-secondary fw-semibold ">{{ __('ui.no_articles_available') }}</h3>
                </div>
            @endforelse
        </div>
        <div class="d-flex justify-content-center">
            <div>{{ $articles->links() }}</div>
        </div>
    </main>
</x-layout>
