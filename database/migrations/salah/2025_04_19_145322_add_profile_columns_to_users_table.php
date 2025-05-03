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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama');
            $table->integer('usia')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->float('berat_badan')->nullable();
            $table->float('tinggi_badan')->nullable();
            $table->float('imt')->nullable(); // Indeks Massa Tubuh
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama', 'usia', 'jenis_kelamin', 'berat_badan', 'tinggi_badan', 'imt']);
            //
        });
    }
};
