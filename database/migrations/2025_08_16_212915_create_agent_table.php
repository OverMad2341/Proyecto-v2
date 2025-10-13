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
        Schema::create('agent', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('agent_type', ['INTERNO', 'EXTERNO', 'AUTOMATICO'])->default('INTERNO');
            $table->enum('agent_role_type', ['USUARIO', 'ADMIN'])->default('USUARIO');
            $table->unsignedBigInteger('employee_id');

            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent');
    }
};
