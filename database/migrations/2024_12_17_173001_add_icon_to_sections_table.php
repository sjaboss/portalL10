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
            $table->string('icon')->nullable();
            $table->string('icon_thumb')->nullable();
            $table->string('icon_medium')->nullable();
            $table->string('icon_large')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('secciones', function (Blueprint $table) {
            $table->dropColumn(['icon', 'icon_thumb', 'icon_medium', 'icon_large']);
        });
    }
};
