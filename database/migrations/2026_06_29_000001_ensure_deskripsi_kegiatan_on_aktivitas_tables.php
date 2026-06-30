<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration ini memastikan kolom deskripsi_kegiatan (longText, nullable)
 * benar-benar ada di kedua tabel aktivitas staf fraksi.
 *
 * Latar belakang: database di-restore dari file SQL yang tidak memiliki
 * kolom ini, sehingga migration sebelumnya (2026_06_26_040753 dan
 * 2026_06_26_040812) sudah tercatat sebagai "Ran" di tabel migrations
 * tapi kenyataannya kolom tidak tersedia di database aktual.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('aktivitas_tenaga_ahli', 'deskripsi_kegiatan')) {
            Schema::table('aktivitas_tenaga_ahli', function (Blueprint $table) {
                $table->longText('deskripsi_kegiatan')->nullable()->after('nama_kegiatan');
            });
        }

        if (!Schema::hasColumn('aktivitas_staf_administrasi', 'deskripsi_kegiatan')) {
            Schema::table('aktivitas_staf_administrasi', function (Blueprint $table) {
                $table->longText('deskripsi_kegiatan')->nullable()->after('nama_kegiatan');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('aktivitas_tenaga_ahli', 'deskripsi_kegiatan')) {
            Schema::table('aktivitas_tenaga_ahli', function (Blueprint $table) {
                $table->dropColumn('deskripsi_kegiatan');
            });
        }

        if (Schema::hasColumn('aktivitas_staf_administrasi', 'deskripsi_kegiatan')) {
            Schema::table('aktivitas_staf_administrasi', function (Blueprint $table) {
                $table->dropColumn('deskripsi_kegiatan');
            });
        }
    }
};
