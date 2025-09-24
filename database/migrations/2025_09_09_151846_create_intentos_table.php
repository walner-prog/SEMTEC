<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('intentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actividad_id')->constrained('actividades')->cascadeOnDelete();
            $table->foreignId('item_id')->nullable()->constrained('items')->nullOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('inicio')->nullable();
            $table->timestamp('fin')->nullable();
            $table->unsignedInteger('aciertos')->default(0);
            $table->unsignedInteger('errores')->default(0);
            $table->integer('tiempo_seg')->nullable();
            $table->json('ayuda_usada')->nullable();
            $table->integer('puntaje')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intentos');
    }
};
