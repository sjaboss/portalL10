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
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('autor');
            $table->string('titulo');
            $table->mediumText('bajada');
            $table->longText('nota');
            $table->string('foto')->nullable();
            $table->string('usuario')->nullable();
            $table->unsignedBigInteger('seccion_id');
            $table->foreign('seccion_id')->references('id')->on('secciones')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
