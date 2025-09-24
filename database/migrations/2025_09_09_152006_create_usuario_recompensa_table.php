<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('usuario_recompensa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('recompensa_id')->constrained('recompensas')->cascadeOnDelete();
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();
            $table->unique(['user_id','recompensa_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario_recompensa');
    }
};
