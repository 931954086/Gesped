<?php

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('permission_user', function (Blueprint $table) {
            $table->foreignId('permission_id')->constrained('permissions');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();

            // Colunas adicionadas acima da definição da chave primária
            $table->primary(['user_id', 'permission_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('permission_user');
    }
};