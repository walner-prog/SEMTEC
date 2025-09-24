<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('recompensas', function (Blueprint $table) {
            $table->id();
            $table->string('clave')->unique();
            $table->string('tipo'); // p.ej. 'medalla','sticker','marco'
            $table->string('icono_url')->nullable();
            $table->text('descripcion')->nullable();
            $table->unsignedInteger('puntos_requeridos')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recompensas');
    }
};
