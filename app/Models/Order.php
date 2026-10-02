<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        
        "shipping_address",
        "payment_method",
        
    ];
       public function user():BelongsTo
{
    return $this->belongsTo(User::class);
}

public function order_items(): HasMany
{
    return $this->hasMany(Order_Item::class);
}
}
