<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('PRODUCTO', function (Blueprint $table) {

            // Primary Key
            $table->string('PRO_CODIGO', 7)->primary();

            // Foreign Keys
            $table->string('CAT_CODIGO', 7);
            // $table->foreign('CAT_CODIGO')->references('CAT_CODIGO')->on('CATEGORIA'); 
            // Comentamos la FK estricta por si la tabla no existe en orden correcto, 
            // pero mantenemos la columna.

            $table->string('CLA_CODIGO', 7);
            $table->string('BOD_CODIGO', 7);

            // Campos principales
            $table->string('PRO_NOMBRE', 120)->nullable();
            $table->string('PRO_DESCRIPCION', 200)->nullable();
            
            $table->integer('PRO_EXISTENCIA')->nullable();
            
            $table->decimal('PRO_PRECIO_VENTA_ANT', 10, 2)->nullable();
            $table->decimal('PRO_PRECIO_VENTA', 10, 2)->nullable();
            $table->decimal('PRO_UTILIDAD', 10, 2)->nullable();
            
            $table->string('PRO_IMAGEN', 300)->nullable();
            $table->string('PRO_ALT_IMAGEN', 120)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('PRODUCTO');
    }
};
