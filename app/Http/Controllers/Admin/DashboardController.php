<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\AnggotaDewan;

use App\Models\AktivitasTenagaAhli;
use App\Models\AktivitasStafAdministrasi;
use App\Models\TenagaAhli;
use App\Models\StafAdministrasi;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Anggota Dewan
        $totalAnggota = AnggotaDewan::aktif()->count();
        $anggotaDewan = AnggotaDewan::aktif()->get();

        // 2. Data TA/SA Fraksi
        $tenagaAhliList = TenagaAhli::aktif()->orderBy('nama_lengkap')->get()->map(function ($item) {
            $item->jenis_staf = 'Tenaga Ahli';
            return $item;
        });
        $stafAdministrasiList = StafAdministrasi::aktif()->orderBy('nama_lengkap')->get()->map(function ($item) {
            $item->jenis_staf = 'Staf Administrasi';
            return $item;
        });
        $daftarStaf = $tenagaAhliList->concat($stafAdministrasiList);
        $totalStaf = $daftarStaf->count();

        // 3. Statistik Aktivitas — 6 nilai efisien (hari ini / bulan ini / tahun ini) × (Dewan / TA+SA)
        $today     = today()->toDateString();
        $bulanIni  = (int) date('n');
        $tahunIni  = (int) date('Y');

        $todayDewan = Aktivitas::hariIni()->count();
        $todayTasa  = AktivitasTenagaAhli::hariIni()->count()
                    + AktivitasStafAdministrasi::hariIni()->count();

        $monthDewan = Aktivitas::bulan($bulanIni, $tahunIni)->count();
        $monthTasa  = AktivitasTenagaAhli::bulan($bulanIni, $tahunIni)->count()
                    + AktivitasStafAdministrasi::bulan($bulanIni, $tahunIni)->count();

        $yearDewan  = Aktivitas::tahun($tahunIni)->count();
        $yearTasa   = AktivitasTenagaAhli::tahun($tahunIni)->count()
                    + AktivitasStafAdministrasi::tahun($tahunIni)->count();

        // 4. Aktivitas Terbaru Dewan
        $aktivitasTerbaruDewan = Aktivitas::with('anggotaDewan')
            ->latest('tanggal')->latest('waktu')->take(7)->get();

        // 5. Aktivitas Terbaru TA/SA
        $ta = AktivitasTenagaAhli::with('tenagaAhli')->latest('tanggal')->latest('waktu')->take(7)->get()->map(function ($item) {
            $item->pelaku = $item->tenagaAhli;
            return $item;
        });
        $sa = AktivitasStafAdministrasi::with('stafAdministrasi')->latest('tanggal')->latest('waktu')->take(7)->get()->map(function ($item) {
            $item->pelaku = $item->stafAdministrasi;
            return $item;
        });
        $aktivitasTerbaruStaf = $ta->concat($sa)->sortByDesc(function ($item) {
            return $item->tanggal->format('Y-m-d') . ' ' . $item->waktu;
        })->take(7);

        return view('admin.dashboard', [
            'totalAnggota'          => $totalAnggota,
            'anggotaDewan'          => $anggotaDewan,
            'totalStaf'             => $totalStaf,
            'daftarStaf'            => $daftarStaf,
            'todayDewan'            => $todayDewan,
            'todayTasa'             => $todayTasa,
            'monthDewan'            => $monthDewan,
            'monthTasa'             => $monthTasa,
            'yearDewan'             => $yearDewan,
            'yearTasa'              => $yearTasa,
            'tahunIni'              => $tahunIni,
            'aktivitasTerbaruDewan' => $aktivitasTerbaruDewan,
            'aktivitasTerbaruStaf'  => $aktivitasTerbaruStaf,
        ]);
    }
}
