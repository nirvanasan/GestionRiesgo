<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Crear tabla Amenazas
        Schema::create('Amenazas', function (Blueprint $table) {
            $table->id(); // Campo id auto incremental
            $table->string('codigo_amenaza')->virtualAs('CONCAT(id, "A")'); // Campo Código con lógica concatenada
            $table->string('descripcion'); // Campo descripción
            $table->string('tipo');
            $table->timestamps(); // Campos created_at y updated_at
        });

        // Crear tabla Debilidades
        Schema::create('Debilidades', function (Blueprint $table) {
            $table->id(); // Campo id auto incremental
            $table->string('codigo_debilidad')->virtualAs('CONCAT(id, "D")'); // Campo Código con lógica concatenada
            $table->string('descripcion'); // Campo descripción
            $table->string('tipo');
            $table->timestamps(); // Campos created_at y updated_at
        });

        // Crear tabla Fortalezas
        Schema::create('Fortalezas', function (Blueprint $table) {
            $table->id(); // Campo id auto incremental
            $table->string('codigo_fortaleza')->virtualAs('CONCAT(id, "F")'); // Campo Código con lógica concatenada
            $table->string('descripcion'); // Campo descripción
            $table->string('tipo');
            $table->timestamps(); // Campos created_at y updated_at
        });

        // Crear tabla Oportunidades
        Schema::create('Oportunidades', function (Blueprint $table) {
            $table->id(); // Campo id auto incremental
            $table->string('codigo_oportunidad')->virtualAs('CONCAT(id, "-O")'); // Campo Código con lógica concatenada
            $table->string('descripcion'); // Campo descripción
            $table->string('tipo');
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Oportunidades');
        Schema::dropIfExists('Fortalezas');
        Schema::dropIfExists('Debilidades');
        Schema::dropIfExists('Amenazas');
    }
};