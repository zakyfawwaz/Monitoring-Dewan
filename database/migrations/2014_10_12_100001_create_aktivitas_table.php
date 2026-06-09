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
        Schema::create('aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_dewan_id')
                  ->constrained('anggota_dewans')
                  ->cascadeOnDelete();
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('nama_kegiatan', 255);
            $table->enum('kategori', [
                // DPRD
                'paripurna',
                'komisi',
                'fraksi',
                'pansus',
                // Masyarakat
                'reses',
                'aspirasi',
                'sosialisasi',
                // Lapangan
                'monitoring',
                'inspeksi',
                // Lainnya
                'audiensi',
                'seminar',
                'mendadak',
            ]);
            $table->string('lokasi', 255);
            $table->text('deskripsi_kegiatan')->nullable();
            $table->string('dokumentasi_foto', 255)->nullable();
            $table->foreignId('dibuat_oleh')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->timestamps();

            // Index untuk query rekap yang sering digunakan
            $table->index('tanggal');
            $table->index('kategori');
            $table->index(['anggota_dewan_id', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas');
    }
};
