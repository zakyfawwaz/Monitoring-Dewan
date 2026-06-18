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
        Schema::table('aktivitas_tenaga_ahli', function (Blueprint $table) {
            $table->time('waktu')->after('tanggal')->default('08:00:00');
            $table->string('kategori')->after('waktu')->default('Lainnya');
        });

        Schema::table('aktivitas_staf_administrasi', function (Blueprint $table) {
            $table->time('waktu')->after('tanggal')->default('08:00:00');
            $table->string('kategori')->after('waktu')->default('Lainnya');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aktivitas_tenaga_ahli', function (Blueprint $table) {
            $table->dropColumn(['waktu', 'kategori']);
        });

        Schema::table('aktivitas_staf_administrasi', function (Blueprint $table) {
            $table->dropColumn(['waktu', 'kategori']);
        });
    }
};
