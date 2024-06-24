<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';


    protected $fillable = [
        'cart_id', 'menu_id', 'quantity', 'total_price'
    ];

    public function menu()
    {
        return  $this->belongsTo(Menu::class, "menu_id");
    }

    public function cart()
    {
        return  $this->belongsTo(Cart::class, "cart_id");
    }
}
