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
        Schema::create('juegos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('icono')->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('puntos_base')->default(0);
            $table->string('tipo')->default('quiz');
            $table->boolean('bloqueado')->default(false);
            $table->integer('requisito_puntos')->nullable();
            $table->integer('requisito_monedas')->nullable();
            $table->integer('requisito_trofeos')->nullable();
            $table->tinyInteger('nivel')->default(1)->comment('Nivel del juego, 1=Primer grado, 2=Segundo grado, ... 6=Sexto grado');
             $table->string('categoria')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juegos');
    }
};
