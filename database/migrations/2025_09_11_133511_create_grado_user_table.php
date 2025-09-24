<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('grado_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grado_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['grado_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('grado_user');
    }
};