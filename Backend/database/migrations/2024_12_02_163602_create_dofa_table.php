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
        Schema::create('dofa', function (Blueprint $table) {
            $table->id(); // Crea un campo "id" int autoincremental
            $table->string('Codigo'); // Campo "Codigo" de tipo varchar
            $table->unsignedBigInteger('id_usuario'); // Campo "id_usuario" de tipo int

            $table->timestamps(); // Agrega campos "created_at" y "updated_at"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dofa');
    }
};
