<?php

namespace Database\Seeders;

use App\Models\Aktivitas;
use App\Models\AnggotaDewan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================================
        // Anggota Dewan Fraksi PKS DPRD Kota Tegal (data contoh)
        // =====================================================================
        $anggota = [
            ['nama_lengkap' => 'H. Ahmad Fauzi, S.Ag', 'jabatan' => 'Ketua Fraksi', 'komisi' => 'Komisi I', 'nomor_hp' => '081234567001'],
            ['nama_lengkap' => 'Dra. Siti Nurhaliza', 'jabatan' => 'Wakil Ketua Fraksi', 'komisi' => 'Komisi II', 'nomor_hp' => '081234567002'],
            ['nama_lengkap' => 'Muhammad Rizki, S.H.', 'jabatan' => 'Sekretaris Fraksi', 'komisi' => 'Komisi III', 'nomor_hp' => '081234567003'],
            ['nama_lengkap' => 'Hj. Fatimah Az-Zahra', 'jabatan' => 'Anggota', 'komisi' => 'Wakil Ketua DPRD', 'nomor_hp' => '081234567004'],
            ['nama_lengkap' => 'Ir. Bambang Suryanto', 'jabatan' => 'Anggota', 'komisi' => 'Komisi I', 'nomor_hp' => '081234567005'],
        ];

        $anggotaModels = [];
        foreach ($anggota as $data) {
            $anggotaModels[] = AnggotaDewan::create(array_merge($data, [
                'fraksi'      => 'PKS',
                'status_aktif' => true,
            ]));
        }

        // =====================================================================
        // User Accounts
        // =====================================================================
        $admin = User::create([
            'name'     => 'Admin Fraksi PKS',
            'email'    => 'admin@pks-tegal.id',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Buat akun untuk semua anggota dewan
        foreach ($anggotaModels as $index => $anggotaModel) {
            User::create([
                'name'             => $anggotaModel->nama_lengkap,
                'email'            => 'anggota' . ($index + 1) . '@pks-tegal.id',
                'password'         => Hash::make('password'),
                'role'             => 'anggota',
                'anggota_dewan_id' => $anggotaModel->id,
            ]);
        }

        // =====================================================================
        // Aktivitas Contoh (30 aktivitas random)
        // =====================================================================
        $kegiatan = [
            ['nama' => 'Rapat Paripurna DPRD Kota Tegal', 'kategori' => 'paripurna', 'lokasi' => 'Gedung DPRD Kota Tegal'],
            ['nama' => 'Rapat Komisi I — Pembahasan APBD', 'kategori' => 'komisi', 'lokasi' => 'Ruang Komisi I DPRD'],
            ['nama' => 'Rapat Fraksi PKS — Konsolidasi', 'kategori' => 'fraksi', 'lokasi' => 'Ruang Fraksi PKS'],
            ['nama' => 'Rapat Pansus Perda Pendidikan', 'kategori' => 'pansus', 'lokasi' => 'Gedung DPRD Kota Tegal'],
            ['nama' => 'Reses di Kelurahan Margadana', 'kategori' => 'reses', 'lokasi' => 'Kelurahan Margadana'],
            ['nama' => 'Penjaringan Aspirasi Masyarakat', 'kategori' => 'aspirasi', 'lokasi' => 'Kecamatan Tegal Barat'],
            ['nama' => 'Sosialisasi Perda Kesehatan', 'kategori' => 'sosialisasi', 'lokasi' => 'Balai Desa Kejambon'],
            ['nama' => 'Monitoring Pembangunan Jalan', 'kategori' => 'monitoring', 'lokasi' => 'Jl. Proklamasi, Tegal'],
            ['nama' => 'Inspeksi Pasar Pagi Kota Tegal', 'kategori' => 'inspeksi', 'lokasi' => 'Pasar Pagi Kota Tegal'],
            ['nama' => 'Audiensi dengan Dinas Pendidikan', 'kategori' => 'audiensi', 'lokasi' => 'Kantor Dinas Pendidikan'],
            ['nama' => 'Seminar Nasional Legislasi Daerah', 'kategori' => 'seminar', 'lokasi' => 'Hotel Grand Karlita, Tegal'],
            ['nama' => 'Kunjungan Kerja Mendadak ke RSUD', 'kategori' => 'mendadak', 'lokasi' => 'RSUD Kardinah Tegal'],
            ['nama' => 'Rapat Komisi II — Bidang Ekonomi', 'kategori' => 'komisi', 'lokasi' => 'Ruang Komisi II DPRD'],
            ['nama' => 'Sosialisasi Program Bantuan UMKM', 'kategori' => 'sosialisasi', 'lokasi' => 'Aula Kecamatan Tegal Timur'],
            ['nama' => 'Monitoring Proyek Normalisasi Sungai', 'kategori' => 'monitoring', 'lokasi' => 'Sungai Gangsa, Tegal'],
        ];

        $waktuOptions = ['08:00', '09:00', '10:00', '13:00', '14:00', '15:30'];

        for ($i = 0; $i < 30; $i++) {
            $keg = $kegiatan[array_rand($kegiatan)];
            $anggotaModel = $anggotaModels[array_rand($anggotaModels)];
            $tanggal = now()->subDays(rand(0, 90))->format('Y-m-d');

            Aktivitas::create([
                'anggota_dewan_id'   => $anggotaModel->id,
                'tanggal'            => $tanggal,
                'waktu'              => $waktuOptions[array_rand($waktuOptions)],
                'nama_kegiatan'      => $keg['nama'],
                'kategori'           => $keg['kategori'],
                'lokasi'             => $keg['lokasi'],
                'deskripsi_kegiatan' => 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.',
                'dibuat_oleh'        => $admin->id,
            ]);
        }
    }
}
