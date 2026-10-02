<div class="col-12 col-md-10 col-lg-8">

    <form wire:submit="store" class="form-box mb-3" enctype="multipart/form-data">
        <div class="mb-5">
            <h1 class="text-center">{{ __('ui.insert_new_listing') }}</h1>
        </div>

        <div class="mb-3">
            <label for="articleTitle" class="form-label">{{ __('ui.name') }} {{ __('ui.item') }}</label>
            <input wire:model="title" type="text" class="form-control shadow" id="articleTitle">
            <div class="text-danger">
                @error('title')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="articleDescription" class="form-label">{{ __('ui.description') }} {{ __('ui.item') }}</label>
            <textarea wire:model="description" class="form-control shadow" id="articleDescription" cols="30" rows="10"></textarea>
            <div class="text-danger">
                @error('description')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="articlePrice" class="form-label">{{ __('ui.price') }} {{ __('ui.item') }}</label>
            <div class="input-group">
                <input wire:model="price" type="number" step="0.01" min="0" class="form-control shadow"
                    id="articlePrice">
                <span class="input-group-text shadow-bottom-right">€</span>
            </div>
            <div class="text-danger">
                @error('price')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <fieldset class="mb-3">
            <legend class="fs-6">{{ __('ui.categories') }}</legend>

            <div class="text-danger">
                @error('categories')
                    {{ $message }}
                @enderror
            </div>
        </fieldset>

        <div class="mb-3 d-flex flex-wrap gap-4">
            @foreach ($categories as $category)
                <div class="form-check">
                    <input class="form-check-input" type="radio" wire:model="category_id"
                        value="{{ $category->id }}" id="category{{ $category->id }}">

                    <label class="form-check-label" for="category{{ $category->id }}">
                        {{ __("ui.$category->name") }}
                    </label>
                </div>
            @endforeach
        </div>

        <div class="text-danger">
            @error('category_id')
                {{ $message }}
            @enderror
        </div>

        <div class="mb-3">
            <label for="articleImages" class="form-label">
                {{ __('ui.item_image') }} {{ __('ui.item') }}
            </label>

            <input wire:model="temporary_images" multiple type="file"
                class="form-control input-group shadow @error('temporary_images.*') is-invalid @enderror"
                id="articleImages" placeholder="Img/">

            <div class="text-danger">
                @error('temporary_images.*')
                    {{ $message }}
                @enderror

                @error('temporary_images')
                    {{ $message }}
                @enderror
            </div>

            @if (!empty($images))
                <div class="mb-3">
                    <p>{{ __('ui.photo_preview') }}:</p>

                    <div class="row border border-4 border-blk rounded shadow py-4">
                        @foreach ($images as $key => $image)
                            <div class="col d-flex flex-column align-items-center my-3">
                                <div class="img-preview mx-auto shadow rounded"
                                    style="background-image: url({{ $image->temporaryUrl() }});"></div>

                                <button type="button" class="btn mt-1 btn-danger"
                                    wire:click="removeImage({{ $key }})"
                                    aria-label="{{ __('ui.remove_image') }}">
                                    X
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="d-flex justify-content-center mt-5">
            <button type="submit" class="btn-submit">
                {{ __('ui.enter') }}
            </button>
        </div>
    </form>

    <x-message />
</div>
