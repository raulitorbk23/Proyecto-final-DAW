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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id('id_pago')->autoIncrement();
            $table->date('fecPago');
            $table->decimal('cantidad', total: 8, places: 2);
            $table->enum('estado',['pendiente','realizado','fallado'])->default('pendiente');

            $table->foreignId('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreignId('id_tarjeta')->references('id_tarjeta')->on('tarjetas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('pagos', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->dropForeign(['id_tarjeta']);
        });

        Schema::dropIfExists('pagos');
    }
};
