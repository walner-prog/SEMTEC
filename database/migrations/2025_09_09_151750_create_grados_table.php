<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
       Schema::create('grados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('escuela_id'); // <-- columna para la relación
            $table->string('nombre'); // "1ro", "2do", "3ro" o "Primer grado"
            $table->text('descripcion')->nullable();
            $table->unsignedSmallInteger('orden')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // clave foránea
            $table->foreign('escuela_id')->references('id')->on('escuelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grados');
    }
};
