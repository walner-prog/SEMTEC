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
        Schema::create('usuario_juego', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('juego_id')->constrained()->onDelete('cascade');
    $table->integer('puntaje')->default(0);
    $table->integer('intentos')->default(0);
    $table->boolean('completado')->default(false);
    $table->timestamp('ultima_partida')->nullable();
    $table->timestamps();

    $table->unique(['user_id', 'juego_id']); // un usuario con un progreso por juego
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_juego');
    }
};
