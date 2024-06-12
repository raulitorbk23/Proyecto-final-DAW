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
            $table->string('pais',30);
            $table->string('localidad',50);
            $table->string('codPostal',10);
            $table->string('direccion',50);
            $table->string('telefono',9);
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
