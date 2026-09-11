@section('navbar-position', 'position-absolute')

<x-layout>
    <div class="container-fluid  p-0">
        <div class="row mx-0">
            <div class="col-12 p-0">
                <header class="bg-category  d-flex align-items-end ">
                    <h1 class="fw-bold text-wh category-title pb-2 ps-4 display-4">{{ __('ui.my_listings') }}</h1>
                </header>
            </div>
        </div>
    </div>
    <main class="container-fluid">
        <div class="row justify-around">
            @if (session('message'))
                <div class="alert alert-danger text-center">
                    {{ session('message') }}
                </div>
            @endif
            @forelse ($articles as $article)
                <div class="col-12 col-lg-5 col-xl-3 col-md-7 my-5 ">
                    <x-card :$article />
                </div>
            @empty
                <div class="col-12">
                    <h3>Non hai ancora inserito nessun annuncio</h3>
                    <a href="{{ route('article.create') }}"><small>Fallo ora!</small></a>
                </div>
            @endforelse
        </div>
    </main>
</x-layout>
