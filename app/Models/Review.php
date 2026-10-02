<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        "content",        
        "rating",
        "reviewer_name",
    ];

    public function user(): BelongsTo{
       return $this->belongsTo(User::class,"reviewer_id");
    }
    public function article(): BelongsTo{
       return $this->belongsTo(Article::class);
    }
    
}
