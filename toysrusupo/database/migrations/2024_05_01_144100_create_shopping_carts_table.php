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
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->id();
            #Foreign key del usuario
            $table->foreignId('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            #Precio total del carrito
            $table->float('total_price')->default(0);
            #Cantidad de productos
            $table->integer('total_products')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_carts');
    }
};
