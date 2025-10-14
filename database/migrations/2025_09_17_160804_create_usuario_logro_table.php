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
       Schema::create('usuario_logro', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('logro_id')->constrained()->onDelete('cascade');
    $table->foreignId('juego_id')->constrained()->onDelete('cascade');
    $table->timestamp('fecha_obtenido')->useCurrent();
    $table->timestamps();

    $table->unique(['user_id', 'logro_id']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_logro');
    }
};
