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
        Schema::table('gaya_hidup', function (Blueprint $table) {
            $table->string('pola_makan')->nullable(); // Sesuaikan tipe data dan apakah kolom ini bisa null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gaya_hidup', function (Blueprint $table) {
            $table->dropColumn('pola_makan');

        });
    }
};
