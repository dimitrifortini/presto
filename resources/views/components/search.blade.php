{{-- SEARCH --}}
<form action="{{ route('article.search') }}" method="GET" role="search" class="d-xl-none input-search nav-item my-3">
    <div class="input-group">
        <input type="search" name="query" class="form-control input-search mb-1" placeholder="{{ __('ui.search') }}"
            aria-label="search">

        <button type="submit" class="btn btn-search" aria-label="{{ __('ui.search') }}">
            <i class="fa-solid fa-magnifying-glass fa-2x text-wh"></i>
        </button>
    </div>
</form>
{{-- SEARCH END --}}
