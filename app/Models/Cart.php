<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Article;
class Cart extends Model
{
    protected $fillable = [
        "user_id",
        "article_id",
        "quantity",

    ];
     public static function cartCount()
{
    return self::where("user_id", auth()->id())->count();
}

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

   public function article(): BelongsTo
{
    return $this->belongsTo(Article::class);
}
}
