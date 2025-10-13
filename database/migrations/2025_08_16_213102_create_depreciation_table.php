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
        Schema::create('depreciation', function (Blueprint $table) {
            
            $table->id('id_depreciation');

            $table->float('initial_value');
            $table->float('current_value');
            $table->date('calculation_date');
            $table->timestamps();

            $table->unsignedBigInteger('id_bien');

            $table->foreign('id_bien')
                ->references('id_bien')
                ->on('national_asset')
                ->cascadeOnDelete();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depreciation');
    }
};
