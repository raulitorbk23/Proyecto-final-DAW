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
        Schema::create('direccion_envios', function (Blueprint $table) {
            $table->id('id_direccion')->autoIncrement();
            $table->timestamps();
            $table->string('pais');
            $table->string('localidad');
            $table->string('codPostal');
            $table->string('direccion');
            $table->string('telefono');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direccion_envios');
    }
};