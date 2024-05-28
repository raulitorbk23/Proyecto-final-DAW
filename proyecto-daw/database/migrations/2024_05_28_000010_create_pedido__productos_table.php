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
        Schema::create('pedido__productos', function (Blueprint $table) {
            $table->primary(['id_pedido','id_producto']);
            $table->integer('cantidadProducto');
            $table->decimal('precioProducto', total: 8, places: 2);


            $table->foreignId('id_pedido')->references('id_pedido')->on('pedidos')->onDelete('cascade');
            $table->foreignId('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {   

        Schema::table('pedido__productos', function (Blueprint $table) {
            $table->dropForeign(['id_pedido']);
            $table->dropForeign(['id_producto']);
        });

        Schema::dropIfExists('pedido__productos');
    }
};
