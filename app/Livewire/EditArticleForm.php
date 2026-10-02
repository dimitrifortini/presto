<?php

namespace App\Livewire;

use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\ResizeImage;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\RemoveFaces;



class EditArticleForm extends Component
{

        use WithFileUploads;    

    public $article;
    public $category;
    #[Validate('required')]
    public $title;
    #[Validate('required')]
    public $description;
    #[Validate('required')]
    public $price ;
    #[Validate('required')]
    public $category_id;
    public $user_id;
    public $images=[];
    public $existingImages = [];
    public $temporary_images;

    public function mount(Article $article){
        if (auth()->id()!==$article->user->id && !auth()->user()->is_admin) {
            abort(403);
        }
        $this->article = $article;
        $this->title= $article->title;
        $this->description= $article->description;
        $this->price= $article->price;
        $this->existingImages= $article->images;
        $this->category_id = $article->category_id;
    }

    public function update()
    {
        if (auth()->id()!==$this->article->user->id && !auth()->user()->is_admin) {
            abort(403);
        }

        $this->validate();



        $this->article->update([
            "title" => $this->title,
            "description" => $this->description,
            "price" => $this->price,
            "category_id" => $this->category_id,
            
        ]);

        if (count($this->images) >0) {
            foreach ($this->images as $image) {
                $newFileName="articles/{$this->article->id}";
                $newImage= $this->article->images()->create(["path"=> $image->store($newFileName,"public")]);               
                RemoveFaces::withChain([
                    new ResizeImage($newImage->path,300,300),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id),

                ])->dispatch($newImage->id);
               
            }
            File::deleteDirectory(storage_path("/app/livewire-tmp"));
        }
        session()->flash("message", __("ui.announce_update"));
        
    }

    public function resetForm()
    {
        $this->title = "";
        $this->description = "";
        $this->price = "";
        $this->category_id = "";
        $this->images=[];
        $this->temporary_images=[];
    }

    public function updatedTemporaryImages()
    {
        if ($this->validate([
            "temporary_images.*"=>"image|max:1024",
            "temporary_images" => "max:6"
        ])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
        }
    }

    public function removeTemporaryImage($key){
        if (in_array($key,array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }

    public function removeExistingImage($id){
        if (auth()->id()!==$this->article->user->id && !auth()->user()->is_admin) {
            abort(403);
        }
        $image=$this->article->images()->find($id);
        if ($image) {
            $image->delete();

            $this->existingImages=$this->article->images()->get();
        }
    }
    public function render()
    {
        return view('livewire.edit-article-form');
    }
}
