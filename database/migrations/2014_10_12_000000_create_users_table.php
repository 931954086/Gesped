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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image', 2048)->nullable();
            $table->unsignedBigInteger('department_id');
            $table->rememberToken();
           // $table->foreignId('current_team_id')->nullable();
            //$table->string('profile_photo_path', 2048)->nullable();
             // Adicione a coluna status_id
             $table->foreign('department_id')->references('id')->on('departments');
             $table->foreignId('status_id')->constrained('statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status_id');
        });
    }
};
