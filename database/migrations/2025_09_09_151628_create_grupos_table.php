<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('escuela_id')->constrained('escuelas')->cascadeOnDelete();
            $table->string('nombre'); // ej: "3A"
            $table->string('grado');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('grupos');
    }
};
