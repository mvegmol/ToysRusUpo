<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function userFavourites(){
        return $this->belongsToMany(User::class, 'favourite_product', 'product_id', 'user_id');
    }

    public static function orderByFavorites()
    {
        return static::select('products.id', 'name', 'description', 'price', 'stock', 'image_url', 'min_age', DB::raw('COUNT(favourite_product.product_id) as total_favorites'))
            ->leftJoin('favourite_product', 'products.id', '=', 'favourite_product.product_id')
            ->groupBy('products.id', 'name', 'description', 'price', 'stock', 'image_url', 'min_age')
            ->orderByDesc('total_favorites')
            ->orderBy('name', 'asc');
    }

    public static function bestSellingProducts()
    {
        return static::select(
                'products.id',
                'products.name',
                'products.description',
                'products.price',
                'products.stock',
                'products.image_url',
                'products.min_age',
                DB::raw('COUNT(orders.id) as total_orders')
            )
            ->leftJoin('order_product', 'products.id', '=', 'order_product.product_id')
            ->leftJoin('orders', 'order_product.order_id', '=', 'orders.id')
            ->groupBy(
                'products.id',
                'products.name',
                'products.description',
                'products.price',
                'products.stock',
                'products.image_url',
                'products.min_age'
            )
            ->orderByDesc('total_orders')
            ->orderBy('products.name', 'asc');
    }

}
