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
            if (Schema::hasColumn('secciones', 'icono')) {
                $table->dropColumn('icono');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('secciones', function (Blueprint $table) {
            if (!Schema::hasColumn('secciones', 'icono')) {
                $table->string('icono')->nullable();
            }
        });
    }
};
