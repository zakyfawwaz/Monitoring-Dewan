<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\AnggotaDewan;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalAnggota'      => AnggotaDewan::aktif()->count(),
            'aktivitasHariIni'  => Aktivitas::hariIni()->count(),
            'aktivitasBulanIni' => Aktivitas::bulan(date('n'))->count(),
            'aktivitasTahunIni' => Aktivitas::tahun(date('Y'))->count(),
            'aktivitasTerbaru'  => Aktivitas::with('anggotaDewan')
                ->latest('tanggal')->latest('waktu')->take(7)->get(),
            'anggotaDewan'      => AnggotaDewan::aktif()->get(),
        ]);
    }
}
