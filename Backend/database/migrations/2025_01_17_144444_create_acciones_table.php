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
        Schema::create('acciones', function (Blueprint $table) {
            $table->id();
            $table->string('id_elemento');
            $table->string('tipo');
            $table->string('informacion');
            $table->string('accion');
            $table->string('responsable');
            $table->string('acciones');
            $table->string('proceso');
            $table->date('fecha_seguimiento');
            $table->date('fecha_cierre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acciones');
    }
};
