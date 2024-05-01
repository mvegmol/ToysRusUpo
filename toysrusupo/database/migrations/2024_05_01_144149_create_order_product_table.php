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
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            #Foreign key del pedido
            $table->foreignId('order_id')->references('id')->on('orders')->constrained()->onDelete('cascade');
            #Foreign key del producto
            $table->foreignId('product_id')->references('id')->on('products')->constrained()->onDelete('cascade');
            #Cantidad de productos
            $table->integer('quantity');
            #Precio total del producto
            $table->float('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
