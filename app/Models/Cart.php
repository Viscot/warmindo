<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;


    protected $table = 'cart';


    protected $fillable = [
        'price', 'user_id', 'status'
    ];

    public function details()
    {
        return $this->hasMany(CartItem::class, "cart_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
