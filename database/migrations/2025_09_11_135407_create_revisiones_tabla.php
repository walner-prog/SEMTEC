<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('revisiones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intento_id')->constrained()->onDelete('cascade');
            $table->foreignId('docente_id')->constrained('users')->onDelete('cascade');
            $table->boolean('revisado')->default(false);
            $table->text('retroalimentacion')->nullable();
            $table->integer('calificacion')->nullable();
            $table->timestamp('fecha_revision')->nullable();
            $table->timestamps();
            
            $table->unique(['intento_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('revisiones');
    }
};