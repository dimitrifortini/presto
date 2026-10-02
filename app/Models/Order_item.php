<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Order_item extends Model
{
    protected $fillable = [
       
        "quantity",
        "price",
    ];

public function order():BelongsTo
{
    return $this->belongsTo(Order::class);
}

public function article():BelongsTo
{
    return $this->belongsTo(Article::class);
}
}
