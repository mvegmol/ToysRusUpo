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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            // Foreign key del usuario
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Dirección
            $table->string('direction');
            // Provincia
            $table->string('province');
            // Código Postal
            $table->string('zip_code');
            // Ciudad
            $table->string('city');
            // País
            $table->string('country');
            // Nombre completo (nombre y apellidos)
            $table->string('full_name');
            // Número de teléfono
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
