@section('navbar-position', 'position-absolute')
<x-layout>
    <main class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 px-0">
                <header class="bg-category d-flex align-items-end">
                    <h1 class="fw-bold text-wh category-title pb-2 ps-4 display-4">{{__("ui.all_articles")}}</h1>
                </header>
            </div>
            @forelse ($articles as $article)
                <div class="col-12 col-lg-5 col-xl-3 col-md-7 my-5 mx-3">
                    <x-card :$article></x-card>
                </div>

            @empty
                <div class="col-12 mt-5">
                    <h3 class="text-center text-secondary fw-semibold "> {{ __('ui.no_articles_available') }}
                    </h3>
                </div>
            @endforelse
        </div>
        <div class="d-flex justify-content-center">
            <div>{{ $articles->links() }}</div>
        </div>
    </main>
</x-layout>
