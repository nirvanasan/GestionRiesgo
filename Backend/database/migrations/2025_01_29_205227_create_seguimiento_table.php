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
            $table->enum('p1', ['Sí', 'No']);
            $table->enum('p2', ['Sí', 'No']);
            $table->enum('p3', ['Sí', 'No']);
            $table->enum('p4', ['Sí', 'No']);
            $table->string('accion_id');
            $table->integer('probabilidad');
            $table->date('fecha');
            $table->integer('impacto');
            $table->integer('valoracion_riesgo');
            $table->integer('valoracion_control');
            $table->integer('valoracion_total');
            $table->text('justificacion')->nullable();
            $table->date('proximo_seguimiento')->nullable();
            //$table->foreign('accion_id')->references('id_elemento')->on('acciones')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seguimiento');
    }
};
