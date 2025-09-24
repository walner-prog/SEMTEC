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
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('juego_id')->constrained()->onDelete('cascade');
            $table->string('enunciado'); // Ej: "¿Cuánto es 5 + 3?"
            $table->json('opciones');   // Ej: ["6","7","8","9"]
            $table->string('respuesta_correcta'); // Ej: "8"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas');
    }
};
