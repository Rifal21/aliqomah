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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // NAMA
            $table->string('nis')->nullable(); // NIS
            $table->string('sex')->nullable(); // SEX (L/P)
            $table->string('ttl')->nullable(); // TTL (Tempat)
            // $table->date('tanggal_lahir')->nullable(); // TTL (Tanggal)
            $table->string('bin')->nullable(); // BIN (Nama Orang Tua)
            $table->integer('tahun_lulus'); // THN (Tahun Lulus)
            $table->string('kelas')->nullable(); // KELAS
            $table->string('status')->nullable(); // STATUS // Testimoni alumni
            $table->timestamps();

            // Indexing
            $table->index('nama');
            $table->index('tahun_lulus');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
