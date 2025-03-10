<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('calificacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedBigInteger('simulacro_id')->nullable();
            $table->unsignedBigInteger('pregunta_id')->nullable(); // CAMBIADO: era preguntas_id
            $table->integer('puntaje')->default(0); // Se asegura de que siempre tenga un valor por defecto
            $table->char('respuesta', 1)->nullable(); // Respuesta seleccionada (A, B, C, D)
            $table->boolean('es_correcta')->nullable(); // Indica si es correcta o no
            $table->timestamps();
            $table->string('titulo_simulacro')->nullable();

            $table->foreign('estudiante_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('simulacro_id')->references('id')->on('simulacros')->onDelete('set null');
            $table->foreign('pregunta_id')->references('id')->on('preguntas')->onDelete('cascade'); // CAMBIADO
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacions');
    }
};
