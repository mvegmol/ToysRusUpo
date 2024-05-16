<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock', 'image_url', 'min_age'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function shoppingCart()
    {
        return $this->belongsToMany(ShoppingCart::class)->withPivot('quantity', 'total_price');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price');
    }


}
