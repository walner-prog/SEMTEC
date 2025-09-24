<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reacciones_juegos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('juego_id')->constrained()->onDelete('cascade');
            $table->enum('tipo', ['me_gusta', 'corazon']);

            $table->timestamps();

            $table->unique(['user_id', 'juego_id', 'tipo']); // evita que un mismo usuario dé el mismo tipo dos veces
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reacciones_juegos');
    }
};
