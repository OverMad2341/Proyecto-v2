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
            $table->string('codigo', 100);
            $table->string('name', 100)->nullable();
            $table->string('serial', 100);
            $table->string('marca', 100)->nullable();
            $table->string('modelo', 100)->nullable();
            $table->string('color', 100);
            $table->string('estado', 100)->nullable();
            $table->unsignedBigInteger('empleado')->nullable();
            $table->foreign('empleado')
                ->references('id')
                ->on('empleados')
                ->onDelete('cascade');
            $table->unsignedBigInteger('ubicacion')->nullable();
            $table->foreign('ubicacion')
                ->references('id')
                ->on('gerencias')
                ->onDelete('cascade');
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias')
                ->onDelete('cascade');
            $table->unsignedBigInteger('subcategoria_id')->nullable();
            $table->foreign('subcategoria_id')
                ->references('id')
                ->on('subcategorias')
                ->onDelete('cascade');
            $table->unsignedBigInteger('sub_subcategoria_id');
            $table->foreign('sub_subcategoria_id')
                ->references('id')
                ->on('subsubcategorias')
                ->onDelete('cascade');
            $table->string('description', 255);
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
