@if (session()->has("message"))
    <div class="w-100 alert alert-success text-center">
        {{session("message")}}
    </div>
@endif