<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        Product::factory()->count(40)->create()->each(function ($product) use ($categories) {
            $categoriesToAttach = $categories->random(rand(1, 3))->pluck('id');
            $product->categories()->attach($categoriesToAttach);
        });
    }
}
