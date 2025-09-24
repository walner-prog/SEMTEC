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
       Schema::create('logros', function (Blueprint $table) {
    $table->id();
    $table->string('titulo');
    $table->text('descripcion')->nullable();
    $table->string('icono')->nullable();
    $table->integer('puntos_requeridos')->default(0); // para desbloquear
    $table->foreignId('juego_id')->nullable()->constrained()->onDelete('cascade'); 
    $table->softDeletes();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logros');
    }
};
