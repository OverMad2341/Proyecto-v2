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
        Schema::create('activos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 100)->nullable();
            $table->string('serial', 100)->nullable();
            $table->string('marca', 100);
            $table->string('modelo', 100)->nullable();
            $table->string('color', 100)->nullable();
            $table->string('estado', 100);
            $table->unsignedBigInteger('empleado')->nullable();
            $table->foreign('empleado')
                ->references('id')
                ->on('empleados')
                ->onDelete('cascade');
            $table->unsignedBigInteger('ubicacion');
            $table->foreign('ubicacion')
                ->references('id')
                ->on('gerencias')
                ->onDelete('cascade');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias')
                ->onDelete('cascade');
            $table->unsignedBigInteger('subcategoria_id');
            $table->foreign('subcategoria_id')
                ->references('id')
                ->on('subcategorias')
                ->onDelete('cascade');
            $table->unsignedBigInteger('subsubcategoria_id');
            $table->foreign('subsubcategoria_id')
                ->references('id')
                ->on('subsubcategorias')
                ->onDelete('cascade');
            $table->string('description', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activos');
    }
};
