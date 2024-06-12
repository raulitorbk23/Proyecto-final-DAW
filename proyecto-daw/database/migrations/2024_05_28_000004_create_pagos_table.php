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
            $table->string('id_transaccion', 20);
            $table->date('fecPago');
            $table->string('email',50);
            $table->decimal('cantidad', total: 8, places: 2);
            $table->string('estado',15)->default('pendiente');
            $table->string('id_cliente',20);

            $table->foreignId('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreignId('id_tarjeta')->references('id_tarjeta')->on('tarjetas')->onDelete('cascade');
            $table->foreignId('id_pedido')->references('id_pedido')->on('pedidos');

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
