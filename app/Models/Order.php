<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        "user_id",
        "total",
        "status",
        "shipping_address",
        "payment_method",
    ];
       public function user():BelongsTo
{
    return $this->belongsTo(User::class);
}

public function items(): HasMany
{
    return $this->hasMany(Order_Item::class);
}
}
