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
        Schema::create('favourite_product', function (Blueprint $table) {
            $table->id();
            #Foreign key del producto
            $table->foreignId('product_id')->references('id')->on('products')->constrained()->onDelete('cascade');
            #Foreign key del usuario
            $table->foreignId('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');


            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourite_product');
    }
};
