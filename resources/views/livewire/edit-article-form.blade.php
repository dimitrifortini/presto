
<main class=" container">
    <div class="row justify-content-center ">
        <div class="col-12 col-md-10 col-lg-8 ">

            <form wire:submit.prevent="update" class="form-box mb-3 mt-5" enctype="multipart/form-data">
                <div class="mb-5">
                    <h2 class="text-center">{{ __('ui.edit_listing') }}</h2>
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
                    <label for="articleDescription" class="form-label">{{ __('ui.description') }}
                        {{ __('ui.item') }}</label>
                    <textarea wire:model="description" class="form-control shadow" id="articleDescription" cols="30" rows="10"></textarea>
                    <div class="text-danger">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3 ">
                    <label for="articlePrice" class="form-label">{{ __('ui.price') }}
                        {{ __('ui.item') }}</label>
                    <div class="input-group">
                        <input wire:model="price" type="number" step="0.01" min="0"
                            class="form-control shadow" id="articlePrice">
                        <span class="input-group-text shadow-bottom-right">€</span>
                    </div>
                    <div class="text-danger">
                        @error('price')
                            {{ $message }}
                        @enderror
                    </div>

                </div>
                <div class="mb-3">
                    <p>{{ __('ui.categories') }}</p>
                    <div class="text-danger">
                        @error('categories')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3 d-flex flex-wrap gap-4">
                    @foreach ($categories as $category)
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" wire:model="category_id"
                                value="{{ $category->id }}">

                            <label class="form-check-label">
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
                    <label class="form-label">Immagine {{ __('ui.item') }}</label>
                    <input wire:model="temporary_images" multiple type="file"
                        class="form-control input-group shadow  @error('temporary_images.*') is-invalid @enderror"
                        placeholder="Img/">
                    <div class="text-danger">
                        @error('temporary_images.*')
                            {{ $message }}
                        @enderror
                        @error('temporary_images')
                            {{ $message }}
                        @enderror
                    </div>
                    @if (!empty($existingImages))
                        <div class="mb-3">
                            @if ($existingImages->isNotEmpty())
                            <p>Actual photo preview:</p>
                                <div class="row border border-4 border-blk rounded shadow py-4">

                                    @foreach ($existingImages as $image)
                                        <div class="col d-flex flex-column align-items-center my-3">
                                            <div class="img-preview mx-auto shadow rounded"
                                                style="background-image: url({{ $image->getUrl(300, 300) }});">
                                            </div>
                                            <button type="button" class="btn mt-1 btn-danger"
                                                wire:click="removeExistingImage({{ $image->id }})">X</button>
                                        </div>
                                        @endforeach
                                    </div>
                                
                            @endif
                        </div>
                    @endif
                    @if (!empty($temporary_images))
                        <div class="mb-3">
                            <p>New photo preview:</p>
                            <div class="row border border-4 border-blk rounded shadow py-4">
                                @foreach ($temporary_images as $key => $image)
                                    <div class="col d-flex flex-column align-items-center my-3">
                                        <div class="img-preview mx-auto shadow rounded"
                                            style="background-image: url({{ $image->temporaryUrl() }});"></div>
                                        <button type="button" class="btn mt-1 btn-danger"
                                            wire:click="removeTemporaryImage({{ $key }})">X</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="d-flex justify-content-center mt-5 ">
                    <button type="submit" class="btn-submit ">{{ __('ui.edit') }}</button>
                </div>
            </form>
            <x-message />
        </div>
    </div>

</main>
