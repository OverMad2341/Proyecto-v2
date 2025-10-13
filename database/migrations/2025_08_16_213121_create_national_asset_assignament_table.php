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
        Schema::create('national_asset_assignament', function (Blueprint $table) {
            $table->id();
            
            $table->date('assignment_date');
            $table->text('observation')->nullable();
            $table->string('assignment_status', 50);
            $table->timestamps();

            $table->unsignedBigInteger('id_bien');
            $table->unsignedBigInteger('id_employee');

            $table->foreign('id_bien')
                ->references('id_bien')
                ->on('national_asset')
                ->onDelete('restrict');

            $table->foreign('id_employee')
                ->references('id')
                ->on('employee')
                ->onDelete('restrict');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('national_asset_assignament');
    }
};
