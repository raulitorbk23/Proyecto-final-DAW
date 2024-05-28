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
        Schema::create('usuario__direccions', function (Blueprint $table) {
            $table->primary(['id_direccion','id_usuario']);
            
            $table->foreignId('id_direccion')->references('id_direccion')->on('direccion_envios')->onDelete('cascade');
            $table->foreignId('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('usuario__direccions', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->dropForeign(['id_direccion']);
        });

        Schema::dropIfExists('usuario__direccions');
    }
};
