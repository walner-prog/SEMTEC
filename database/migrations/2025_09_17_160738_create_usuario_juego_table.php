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

            // 🔹 Control de actividad
            $table->timestamp('ultima_partida')->nullable();

            // 🔥 Control de rachas y estadísticas
            $table->integer('racha_actual')->default(0);
            $table->integer('racha_maxima')->default(0);
            $table->integer('dias_jugados')->default(0);

            $table->timestamps();

            // Evita duplicar registros por usuario y juego
            $table->unique(['user_id', 'juego_id']);
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
