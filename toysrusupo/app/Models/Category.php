<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public static function bestCategories()
    {
        return static::select('categories.id', 'categories.name', 'categories.description', DB::raw('COUNT(orders.id) as total_orders'))
            ->leftJoin('category_product', 'categories.id', '=', 'category_product.category_id')
            ->leftJoin('products', 'category_product.product_id', '=', 'products.id')
            ->leftJoin('order_product', 'products.id', '=', 'order_product.product_id')
            ->leftJoin('orders', 'order_product.order_id', '=', 'orders.id')
            ->groupBy('categories.id', 'categories.name', 'categories.description')
            ->orderByDesc('total_orders')
            ->orderBy('categories.id') // Orden secundaria para evitar que se altere el orden de las categorías con el mismo número de ventas
            ->get();
    }
}
