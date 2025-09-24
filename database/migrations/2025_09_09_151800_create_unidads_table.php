<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grado_id')->constrained('grados')->cascadeOnDelete();
             $table->foreignId('docente_id')->constrained('users')->cascadeOnDelete();
        
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->unsignedSmallInteger('orden')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};
