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
        Schema::create('gaya_hidup', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
        $table->integer('durasi_tidur')->nullable();
        $table->enum('konsistensi_tidur', ['konsisten', 'tidak_konsisten'])->nullable();
        $table->boolean('begadang')->default(false);
        $table->integer('frekuensi_sayur')->nullable();
        $table->integer('frekuensi_fastfood')->nullable();
        $table->boolean('sarapan')->default(true);
        $table->integer('durasi_olahraga')->nullable(); // menit per minggu
        $table->integer('frekuensi_olahraga')->nullable();
        $table->float('konsumsi_air')->nullable(); // liter per hari
        $table->boolean('merokok')->default(false);
        $table->boolean('konsumsi_kafein')->default(false);
        $table->enum('tingkat_stress', ['rendah', 'sedang', 'tinggi'])->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaya_hidup');
    }
};
