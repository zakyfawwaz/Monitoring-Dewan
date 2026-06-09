<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;

class DashboardController extends Controller
{
    public function index()
    {
        $anggotaId = auth()->user()->anggota_dewan_id;

        return view('anggota.dashboard', [
            'aktivitasHariIni'  => $anggotaId ? Aktivitas::milikAnggota($anggotaId)->hariIni()->count() : 0,
            'aktivitasBulanIni' => $anggotaId ? Aktivitas::milikAnggota($anggotaId)->bulan(date('n'))->count() : 0,
            'aktivitasTahunIni' => $anggotaId ? Aktivitas::milikAnggota($anggotaId)->tahun(date('Y'))->count() : 0,
            'aktivitasTerbaru'  => $anggotaId
                ? Aktivitas::milikAnggota($anggotaId)->latest('tanggal')->latest('waktu')->take(5)->get()
                : collect(),
        ]);
    }
}
