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
        Schema::create('controles', function (Blueprint $table) {

            $table->id();
            $table->string('id_elemento');
            $table->string('usuario');
            $table->string('tipo');
            $table->string('descripcion');
            $table->string('probabilidad');
            $table->string('impacto');
            $table->boolean('acciones')->default(false);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('controles');
    }
};