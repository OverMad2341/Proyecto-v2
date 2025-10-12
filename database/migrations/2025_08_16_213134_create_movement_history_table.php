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
        Schema::create('movement_history', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('id_bien');
            $table->unsignedBigInteger('id_organizational_uni');
           $table->unsignedBigInteger('id_made_by');


            $table->foreign('id_bien')
                ->references('id_bien')
                ->on('national_asset')
                ->onDelete('restrict');
            
            $table->foreign('id_organizational_uni')
                ->references('id')
                ->on('organizational_uni')
                ->onDelete('restrict');

             $table->foreign('id_made_by')
                ->references('id')
                ->on('employee')
                ->onDelete('restrict');

            $table->timestamp('movement_date');
            $table->text('reason')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movement_history');
    }
};
