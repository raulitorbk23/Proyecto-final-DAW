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
        Schema::create('subcategorias', function (Blueprint $table) {
            $table->id('id_subcategoria')->autoIncrement();
            $table->string('nombre',30);

            $table->foreignId('id_categoria')->references('id_categoria')->on('categorias')->onDelete('cascade');

            $table->primary(['id_subcategoria','id_categoria']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('subcategorias', function (Blueprint $table) {
            $table->dropForeign(['id_categoria']);
        });

        Schema::dropIfExists('subcategorias');
    }
};
