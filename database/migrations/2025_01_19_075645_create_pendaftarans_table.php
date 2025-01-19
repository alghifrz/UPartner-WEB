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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id(); // id_pendaftaran
            $table->foreignId('id_proyek')->constrained('proyeks')->onDelete('cascade');
            $table->foreignId('id_mahasiswa')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('id_dosen')->nullable()->constrained('dosens')->onDelete('cascade');
            $table->text('alasan_mendaftar');
            $table->json('persyaratan_kemampuan'); // JSON tipe untuk banyak nilai
            $table->string('role');
            $table->enum('status', ['Menunggu', 'Diterima', 'Ditolak'])->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
