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
        Schema::table('publicidades', function (Blueprint $table) {
            $table->string('foto_small')->nullable();
            $table->string('foto_medium')->nullable();
            $table->string('foto_large')->nullable();
            $table->integer('orden')->default(0);
            $table->text('descripcion')->nullable();
            $table->string('titulo')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->boolean('activo')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publicidades', function (Blueprint $table) {
            $table->dropColumn('foto_small');
            $table->dropColumn('foto_medium');
            $table->dropColumn('foto_large');
            $table->dropColumn('orden');
            $table->dropColumn('descripcion');
            $table->dropColumn('titulo');
            $table->dropColumn('fecha_inicio');
            $table->dropColumn('fecha_fin');
            $table->dropColumn('activo');
        });
    }
};
