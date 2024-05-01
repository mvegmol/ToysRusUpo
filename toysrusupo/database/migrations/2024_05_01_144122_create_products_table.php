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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            #Nombre del producto
            $table->string('name');
            #Descripción del producto
            $table->text('description');
            #Precio del producto
            $table->float('price');
            #Stock del producto
            $table->integer('stock');
            #Imagen del producto
            $table->string('image_url')->nullable();
            #Edad mínima para el producto
            $table->integer('min_age');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
