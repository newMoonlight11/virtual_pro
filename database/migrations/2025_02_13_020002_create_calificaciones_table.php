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
            $table->unsignedBigInteger('simulacro_id');
            $table->integer('puntaje');
            $table->foreign('estudiante_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('simulacro_id')->references('id')->on('simulacros')->onDelete('cascade');
            $table->foreignId('preguntas_id')->constrained()->onDelete('cascade'); // Relación con preguntas
            $table->char('respuesta', 1)->nullable(); // Respuesta seleccionada (A, B, C, D)
            $table->boolean('es_correcta')->nullable(); // Indica si es correcta o no
            $table->timestamps();
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
