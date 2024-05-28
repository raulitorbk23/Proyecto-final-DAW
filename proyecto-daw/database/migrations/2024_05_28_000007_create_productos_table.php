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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto')->autoIncrement();
            $table->timestamps();
            $table->string('nombre', 50)->unique();
            $table->string('descripcion');
            $table->string('imagen')->nullable();
            $table->decimal('precioCompra', 8, 2);
            $table->decimal('precioVenta', 8, 2);
            $table->decimal('descuento', 8, 2);
            $table->integer('stock');

            // Define las claves foráneas de manera individual
            $table->foreignId('id_subcategoria')->references('id_subcategoria')->on('subcategorias')->onDelete('cascade');
            $table->foreignId('id_categoria')->references('id_categoria')->on('subcategorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            // Elimina las claves foráneas
            $table->dropForeign(['id_categoria']);
            $table->dropForeign(['id_subcategoria']);
        });

        Schema::dropIfExists('productos');
    }
};
