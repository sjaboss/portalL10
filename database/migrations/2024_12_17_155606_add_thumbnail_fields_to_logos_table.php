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
        Schema::table('logos', function (Blueprint $table) {
            $table->string('foto_thumb')->nullable()->after('foto');
            $table->string('foto_medium')->nullable()->after('foto_thumb');
            $table->string('foto_large')->nullable()->after('foto_medium');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logos', function (Blueprint $table) {
            $table->dropColumn(['foto_thumb', 'foto_medium', 'foto_large']);
        });
    }
};
