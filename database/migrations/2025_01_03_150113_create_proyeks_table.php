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
        Schema::create('proyeks', function (Blueprint $table) {
            $table->id();
            $table->string('judul_proyek');
            $table->text('deskripsi_proyek');
            $table->date('tanggal_mulai'); 
            $table->date('tanggal_selesai');
            $table->json('persyaratan_kemampuan')->nullable();
            $table->json('spesifikasi_perangkat')->nullable();
            $table->enum('status_proyek', ['belum dimulai', 'sedang berlangsung', 'selesai'])->default('belum dimulai');
            $table->unsignedBigInteger('proyek_manajer_id')->nullable();
            $table->foreign('proyek_manajer_id')->references('id')->on('dosens')->onDelete('set null');
            $table->string('sampul')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proyeks', function (Blueprint $table) {
            $table->dropForeign(['proyek_manajer_id']);
            $table->dropColumn('proyek_manajer_id');
        });
    }
};
