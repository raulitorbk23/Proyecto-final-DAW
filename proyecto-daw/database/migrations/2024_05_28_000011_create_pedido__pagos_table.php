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
        Schema::create('pedido__pagos', function (Blueprint $table) {
            $table->primary(['id_pago','id_pedido']);
            
            $table->foreignId('id_pago')->references('id_pago')->on('pagos')->onDelete('cascade');
            $table->foreignId('id_pedido')->references('id_pedido')->on('pedidos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('pedido__pagos', function (Blueprint $table) {
            $table->dropForeign(['id_pago']);
            $table->dropForeign(['id_pedido']);
        });


        Schema::dropIfExists('pedido__pagos');
    }
};
