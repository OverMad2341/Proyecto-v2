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
        Schema::create('users', function (Blueprint $table) {
            
            $table->id(); // Fortify espera "id"
            $table->bigInteger('cedula')->unique();

            // ---- Nombres ---- /
            $table->string('name', 50);
            $table->string('name_02', 50)->nullable();
            $table->string('surname_01', 50);
            $table->string('surname_02', 50)->nullable();

            // ---- Datos personales ----
            $table->date('birth_date')->nullable();
            $table->string('birth_place', 100)->nullable();
            $table->enum('sex', ['M', 'F', 'O'])->nullable();
            $table->string('nationality', 50)->nullable();

            // ---- Cuenta ----
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            // ---- Relaciones y extras ----
            $table->unsignedBigInteger('birth_country')->nullable();
            $table->foreign('birth_country')
                ->references('id')
                ->on('country')
                ->onDelete('cascade');

            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();

            $table->timestamps();
        });

        // Reset tokens
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Sesiones
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id')->nullable()->index();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};