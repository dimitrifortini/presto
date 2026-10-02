@section('navbar-position', 'position-absolute')

<x-layout>

    <div class="container-fluid p-0">

        <div class="row mx-0">

            <div class="col-12 p-0">

                <header class="bg-category d-flex align-items-end">

                    <h1 class="fw-bold text-wh category-title pb-2 ps-4 display-4">
                        {{ ucfirst(__('ui.my_profile')) }}
                    </h1>

                </header>

            </div>

        </div>

    </div>


    <div class="container">

        <div class="row d-flex justify-content-center align-items-center flex-column px-lg-0 px-3">

            <div class="col-12 text-center">

                <h2 class="mt-5 mb-3 fw-semibold display-2">
                    {{ Auth::user()->name }}
                </h2>

                <img src="https://picsum.photos/200" alt="{{ __('ui.user_avatar') }}" class="rounded-circle mb-3">

                <p class="text-muted text-center h5">
                    {{ __('ui.member_since', ['year' => 2026]) }}
                </p>

            </div>


            <div class="col-12 col-md-10 col-lg-6 d-flex justify-content-center my-5 p-0">

                <div class="form-box shadow-lg w-100">

                    <h2 class="fw-semibold mb-5">
                        {{ __('ui.personal_data') }}
                        <i class="fa-solid fa-gear me-auto ms-2" aria-hidden="true"></i>
                    </h2>

                    <form action="{{ route('user.update') }}" method="POST"
                        class="d-flex justify-content-center flex-column align-items-center">

                        @csrf
                        @method('PUT')

                        <div class="mb-4 w-100">

                            <label for="userName" class="form-label">
                                {{ __('ui.full_name') }}
                            </label>

                            <input type="text" name="name" class="form-control shadow"
                                value="{{ Auth::user()->name }}" id="userName" placeholder="">

                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="mb-4 w-100">

                            <label for="userEmail" class="form-label">
                                {{ __('ui.email') }}
                            </label>

                            <input type="email" name="email" class="form-control shadow"
                                value="{{ Auth::user()->email }}" id="userEmail" aria-describedby="emailHelp">

                            @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <button type="submit" class="btn btn-submit mt-5">
                            {{ __('ui.edit') }}
                        </button>

                    </form>

                </div>

            </div>

        </div>


        <div class="row px-lg-0 px-3">

            <a href="{{ route('order.index') }}"
                class="col-12 text-decoration-none text-blk col-lg-6 offset-md-1 offset-lg-3 d-flex align-items-center form-box py-2 mb-5 shadow">

                <h2 class="fw-semibold">
                    {{ __('ui.your_orders') }}
                </h2>

                <img class="img-fluid ms-auto pack" src="{{ asset('media/packaging.png') }}"
                    alt="{{ __('ui.package_image') }}">

                <span>
                    <i class="fa-solid fa-angle-right fa-2x" aria-hidden="true"></i>
                </span>

            </a>


            <a href="{{ route('review.index') }}"
                class="col-12 col-lg-6 offset-md-1 offset-lg-3 text-decoration-none text-blk d-flex align-items-center form-box py-2 mb-5 shadow">

                <h2 class="fw-semibold">
                    {{ __('ui.your_reviews') }}
                </h2>

                <img src="{{ asset('media/stella.png') }}" alt="{{ __('ui.star_image') }}"
                    class="img-fluid ms-auto pack">

                <span>
                    <i class="fa-solid fa-angle-right fa-2x ms-3" aria-hidden="true"></i>
                </span>

            </a>

        </div>

    </div>

</x-layout>
