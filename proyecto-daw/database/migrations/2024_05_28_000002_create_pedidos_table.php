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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('id_pedido')->autoIncrement();
            $table->date('fecIni');
            $table->date('fecFin')->nullable();
            $table->string('estado',['pendiente','realizado','fallado'])->default('pendiente');
            $table->decimal('precioTotal', total: 8, places: 2);


            $table->foreignId('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreignId('id_direccion')->references('id_direccion')->on('direccion_envios')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->dropForeign(['id_direccion']);
        });

        Schema::dropIfExists('pedidos');
    }
};
