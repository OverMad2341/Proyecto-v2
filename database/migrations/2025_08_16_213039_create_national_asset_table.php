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
        Schema::create('national_asset', function (Blueprint $table) {
            $table->id('id_bien'); 
            $table->string('asset_code', 100)->unique();
            $table->string('description', 255);
            $table->string('brand', 100)->nullable();
            $table->string('model', 100)->nullable();
            $table->string('serial_number', 150)->nullable()->unique();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_value', 15, 2)->nullable();
            $table->string('status', 50)->default('available');
            $table->string('vin', 17)->unique();
            $table->string('plate_number', 12)->unique();
            $table->string('material', 50);
            $table->timestamps();


            $table->unsignedBigInteger('id_category');
            $table->unsignedBigInteger('id_location');
            
            $table->foreign('id_category')
                ->references('id')
                ->on('category')
                ->onDelete('restrict');

            $table->foreign('id_location')
                ->references('id')
                ->on('location')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('national_asset');
    }
};
