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
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
    
            $table->string('position', 100);
            $table->boolean('is_active')->default(true);

            $table->unsignedBigInteger('organizational_uni'); 

            $table->foreign('organizational_uni')
                ->references('id')
                ->on('organizational_uni')
                ->onDelete('cascade');

            $table->unsignedBigInteger('users');

            $table->foreign('users')
                ->references('cedula')
                ->on('users')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
