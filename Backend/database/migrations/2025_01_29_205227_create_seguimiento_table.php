<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('seguimiento', function (Blueprint $table) {
            $table->id();
            $table->text('control_actual');
            $table->enum('documentado', ['Sí', 'No']);
            $table->enum('implementado', ['Sí', 'No']);
            $table->enum('cierre', ['Sí', 'No']);
            $table->enum('riesgoN', ['Sí', 'No']);
            $table->date('fecha');
            $table->integer('probabilidad');
            $table->integer('impacto');
            $table->integer('valoracion_control');
            $table->integer('valoracion_riesgo');
            $table->integer('valoracion_total');
            $table->text('justificacion')->nullable();
            $table->unsignedBigInteger('accion_id');
            $table->foreign('accion_id')->references('id')->on('acciones')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seguimiento');
    }
};
