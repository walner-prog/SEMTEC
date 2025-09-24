<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('escuelas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('codigo_mined')->nullable();
            $table->string('municipio')->nullable();
            $table->string('departamento')->nullable();
            $table->string('pais')->default('Nicaragua');
            $table->string('tipo')->nullable(); // Pública, Privada, etc.
            $table->integer('anio_fundacion')->nullable();
            $table->string('director')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('escuelas');
    }
};
