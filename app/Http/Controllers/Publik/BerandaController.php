<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\AnggotaDewan;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        return view('publik.beranda', [
            'totalAnggota'      => AnggotaDewan::aktif()->count(),
            'totalAktivitas'    => Aktivitas::tahun(date('Y'))->count(),
            'aktivitasBulanIni' => Aktivitas::bulan(date('n'))->count(),
            'aktivitasTerbaru'  => Aktivitas::with('anggotaDewan')
                ->latest('tanggal')->latest('waktu')->take(5)->get(),
        ]);
    }

    public function aktivitasPublik(Request $request)
    {
        $query = Aktivitas::with('anggotaDewan')->latest('tanggal')->latest('waktu');

        if ($request->filled('bulan')) {
            $query->bulan((int) $request->bulan);
        }
        if ($request->filled('kategori')) {
            $query->kategori($request->kategori);
        }
        if ($request->filled('cari')) {
            $query->where('nama_kegiatan', 'like', '%' . $request->cari . '%');
        }

        return view('publik.aktivitas', [
            'aktivitas' => $query->paginate(15),
        ]);
    }

    public function statistik()
    {
        $tahun = date('Y');
        $totalAktivitas = Aktivitas::tahun($tahun)->count();

        return view('publik.statistik', [
            'totalAktivitas' => $totalAktivitas,
            'perKategori'    => Aktivitas::tahun($tahun)
                ->selectRaw('kategori, COUNT(*) as total')
                ->groupBy('kategori')
                ->orderByDesc('total')
                ->get(),
            'perAnggota'     => Aktivitas::tahun($tahun)
                ->with('anggotaDewan')
                ->selectRaw('anggota_dewan_id, COUNT(*) as total')
                ->groupBy('anggota_dewan_id')
                ->orderByDesc('total')
                ->get(),
        ]);
    }

    public function laporanPublik()
    {
        $tahun = date('Y');
        $laporanBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $laporanBulanan[] = [
                'bulan'        => $i,
                'total'        => Aktivitas::bulan($i, $tahun)->count(),
                'anggota_aktif' => Aktivitas::bulan($i, $tahun)->distinct('anggota_dewan_id')->count('anggota_dewan_id'),
            ];
        }

        return view('publik.laporan', [
            'laporanBulanan' => $laporanBulanan,
        ]);
    }
}
