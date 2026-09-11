@section('navbar-position', 'position-absolute')

<x-layout>
    <div class="container-fluid  p-0">
        <div class="row mx-0">
            <div class="col-12 p-0">
                <header class="bg-category  d-flex align-items-end ">
                    <h2 class="fw-bold text-wh category-title pb-2 ps-4 display-4">{{ ucfirst(__('ui.my_profile')) }}
                    </h2>
                </header>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center flex-column">
            <div class="col-12 text-center">
                <h2 class="mt-5 mb-3 fw-semibold display-2">{{ Auth::user()->name }}</h2>
                <img src="https://picsum.photos/200" alt="Avatar Utente" class="rounded-circle mb-3">
                <p class="text-muted text-center h5">Membro dal 2026</p>
            </div>
            <div class="col-12 col-md-10 col-lg-6  d-flex justify-content-center my-5 p-0">

                <div class="form-box shadow-lg  w-100 ">
                    <h3 class="fw-semibold mb-5">Dati personali <i class="fa-solid fa-gear me-auto ms-2"></i></h3>
                    <form action="{{route("user.update")}}" method="POST" class="d-flex justify-content-center flex-column align-items-center">
                        @csrf
                        @method("PUT")
                        <div class="mb-4 w-100">
                            <label for="userName" class="form-label">{{ __('ui.full_name') }}</label>
                            <input type="name" name="name" class="form-control shadow" value="{{Auth::user()->name}}" id="userName"
                                placeholder="">
                            @error('name')
                                <div class="text-danger ">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4 w-100">
                            <label for="userEmail" class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control shadow" value="{{Auth::user()->email}}" id="exampleInputEmail1"
                                aria-describedby="emailHelp">                            
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-submit mt-5">Modifica</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
        <a href="{{route("user.orders")}}"  class="col-12 text-decoration-none text-blk col-lg-6 offset-md-1 offset-lg-3  d-flex align-items-center form-box py-2 mb-5 shadow">
            <h3 class="fw-semibold">I miei ordini </h3>
            <img class="img-fluid ms-auto pack" src="{{asset("media/packaging.png")}}" alt="Immagine di un pacco presto ">
            <span><i class="fa-solid fa-angle-right fa-2x"></i></span>
        </a>
        <a href="{{route("user.reviews")}}" class="col-12  col-lg-6 offset-md-1 offset-lg-3  text-decoration-none text-blk d-flex align-items-center form-box py-2 mb-5 shadow">
            <h3 class=" fw-semibold">Le mie recensioni</h3>
            <img src="{{asset("media/stella.png")}}" alt="Immagine di una stella" class="img-fluid ms-auto pack">
            <span><i class="fa-solid fa-angle-right fa-2x ms-3"></i></span>
        </a>
        </div>
    </div>
</x-layout>
<i class="fa-solid fa-box-open"></i>