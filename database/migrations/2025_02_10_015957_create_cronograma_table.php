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
        Schema::create('cronogramas', function (Blueprint $table) {
            $table->id();
            $table->string('evento');
            $table->dateTime('fecha');
            $table->unsignedBigInteger('profesor_id')->nullable();
            $table->foreign('profesor_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cronogramas');
    }
};
