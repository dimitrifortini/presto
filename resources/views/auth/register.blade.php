@section('navbar-class', 'navbar-bg')
<x-layout>
    <section class="container  my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 ">

                <form action="{{ route('register.store') }}" method="POST" class="form-box">
                    @csrf
                    <div class="mb-3">
                        <h2 class="text-center h1 fw-semibold ">{{ __('ui.register') }}</h2>
                        <p class="text-secondary text-center mb-4">{{ __('ui.welcome') }}!</p>
                    </div>
                    <div class="mb-4">
                        <label for="userName" class="form-label">{{ __('ui.full_name') }}</label>
                        <input type="name" name="name" class="form-control shadow" id="userName">
                        @error('name')
                            <div class="text-danger ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="userEmail" class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control shadow" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">{{ __('ui.email_privacy') }}.</div>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="userPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control shadow" id="userPassword">
                        @error('password')
                            <div class="text-danger mb-4">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="userConfirmPassword" class="form-label">{{ __('ui.confirm') }} Password</label>
                        <input type="password" name="password_confirmation" class="form-control shadow"
                            id="userConfirmPassword">
                        @error('password_confirmation')
                            <div class="text-danger mb-4">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <button type="submit" class="btn-submit shadow-sm">{{ __('ui.enter') }}</button>

                    </div>
                    <div class="mt-4">
                        <p class="d-inline ">{{ __('ui.already_have_account') }}?</p>
                        <a href="{{ route('login') }}">{{ __('ui.login') }}!</a>

                    </div>
                </form>

            </div>
        </div>
    </section>

</x-layout>
