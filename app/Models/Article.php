<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Override;

class Article extends Model
{
    use Searchable;

    protected $fillable = [
        "title",
        "description",
        "price",
        "category_id",
        "user_id",
    ];

    public function category(): BelongsTo{
       return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo{
       return $this->belongsTo(User::class);
    }

    public function userRevisor(): BelongsTo{
       return $this->belongsTo(User::class,"revisor_id");
    }

    public function setAccepted($value){
        $this->is_accepted=$value;
        $this->save();
        return true;
    }

    public static function toBeRevisedCount(){
        return Article::where("is_accepted",null)->count();
    }

    
    public function toSearchableArray()
    {
        return[
            "id"=>$this->id,
            "title"=>$this->title,
            "description"=>$this->description,
            "category"=>$this->category,
        ];
    }

    public function images() :HasMany{
        return $this->hasMany(Image::class);
    }
    public function reviews() :HasMany{
        return $this->hasMany(Review::class);
    }
}
