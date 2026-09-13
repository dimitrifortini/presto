
<form action="{{ route('setLocale', $lang) }}" method="POST" class="d-block">
    @csrf
    <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-1">
        <img src="{{ asset('vendor/blade-flags/country-'.$lang.'.svg') }}" width="20" height="20" alt="bandiera lingua">
        <span>
            @switch($lang)
                @case("it") {{ __('ui.italian') }} @break
                @case("uk") {{ __('ui.english') }} @break
                @case("es") {{ __('ui.spanish') }} @break
            @endswitch
        </span>
    </button>
</form>