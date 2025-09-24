<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indicador_id')->constrained('indicadores')->cascadeOnDelete();
            $table->string('titulo');
            $table->text('objetivo')->nullable();
            $table->string('tipo')->default('practica'); // practica, cronometro, problema
            $table->json('accesibilidad_flags')->nullable(); // ej: {"tts":true,"isn":false}
            $table->string('media_video')->nullable(); // YouTube, Vimeo, etc.
            $table->string('media_documento')->nullable(); // PDF, PPT, imagen

            $table->unsignedTinyInteger('dificultad_min')->default(1);
            $table->unsignedTinyInteger('dificultad_max')->default(3);
            $table->unsignedSmallInteger('orden')->default(0);
            $table->boolean('con_tiempo')->default(false);
            $table->integer('limite_tiempo')->nullable(); // en minutos

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actividades');
    }
};
