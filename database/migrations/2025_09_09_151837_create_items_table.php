<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actividad_id')->constrained('actividades')->cascadeOnDelete();
            $table->text('enunciado');
            $table->json('datos')->nullable(); // parámetros para generar ítems
            $table->json('respuesta')->nullable(); // estructura de respuesta esperada
            $table->json('retro')->nullable(); // retroalimentación
            $table->unsignedSmallInteger('orden')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
