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
        Schema::create('usuario__tarjetas', function (Blueprint $table) {
            $table->primary(['id_tarjeta','id_usuario']);
            
            $table->foreignId('id_tarjeta')->references('id_tarjeta')->on('tarjetas')->onDelete('cascade');
            $table->foreignId('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('usuario__tarjetas', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->dropForeign(['id_tarjeta']);
        });

        Schema::dropIfExists('usuario__tarjetas');
    }
};
