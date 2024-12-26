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
        Schema::table('secciones', function (Blueprint $table) {
            // Primero eliminamos la columna icono si existe
            if (Schema::hasColumn('secciones', 'icono')) {
                $table->dropColumn('icono');
            }
            
            // Modificamos las columnas existentes para que sean nullable
            $table->string('icon')->nullable()->change();
            $table->string('icon_thumb')->nullable()->change();
            $table->string('icon_medium')->nullable()->change();
            $table->string('icon_large')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('secciones', function (Blueprint $table) {
            if (Schema::hasColumn('secciones', 'icono')) {
                $table->string('icono')->nullable(false)->change();
            }
            $table->string('icon')->nullable(false)->change();
            $table->string('icon_thumb')->nullable(false)->change();
            $table->string('icon_medium')->nullable(false)->change();
            $table->string('icon_large')->nullable(false)->change();
        });
    }
};
