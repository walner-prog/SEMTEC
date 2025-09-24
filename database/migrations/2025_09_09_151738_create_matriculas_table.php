<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // estudiante
            $table->foreignId('escuela_id')->constrained('escuelas')->cascadeOnDelete();
            $table->foreignId('docente_id')->constrained('users')->cascadeOnDelete();  
            $table->string('grado')->nullable(); // ej: "3"
            $table->string('seccion')->nullable(); // ej: "A"
            $table->year('anio')->nullable();
            $table->date('fecha_matricula')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
