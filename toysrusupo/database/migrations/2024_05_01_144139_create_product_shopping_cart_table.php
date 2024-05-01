<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_shopping_cart', function (Blueprint $table) {
            $table->id();
            #Foreign key del producto
            $table->foreignId('product_id')->references('id')->on('products')->constrained()->onDelete('cascade');
            #Foreign key del carrito
            $table->foreignId('shopping_cart_id')->references('id')->on('shopping_carts')->constrained()->onDelete('cascade');
            #Cantidad de productos
            $table->integer('quantity');
            #Precio total del producto
            $table->float('total_price');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_shopping_cart');
    }
};
