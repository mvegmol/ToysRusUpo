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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            #Foreign key del usuario
            $table->foreignId('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            #Precio total del pedido
            $table->float('total_price')->default(0);
            #Dirección de envío
            $table->string('address');
            #Estado del pedido
            $table->enum(_('status'), ['pending','accepted' ,'in progress','delivered', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
