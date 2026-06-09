<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\AnggotaDewan;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function bulanan(Request $request)
    {
        $bulan = $request->get('bulan', date('n'));
        $tahun = $request->get('tahun', date('Y'));

        $aktivitas = Aktivitas::with('anggotaDewan')->bulan($bulan, $tahun);
        $rekapData = $this->buildRekapPerAnggota($aktivitas);

        return view('admin.rekap.index', array_merge($rekapData, [
            'judulPeriode' => 'Bulanan',
            'showBulan'    => true,
            'bulan'        => $bulan,
            'tahun'        => $tahun,
        ]));
    }

    public function triwulan(Request $request)
    {
        $triwulan = $request->get('triwulan', ceil(date('n') / 3));
        $tahun    = $request->get('tahun', date('Y'));
        $dari     = "{$tahun}-" . str_pad(($triwulan - 1) * 3 + 1, 2, '0', STR_PAD_LEFT) . "-01";
        $sampai   = date('Y-m-t', strtotime("{$tahun}-" . str_pad($triwulan * 3, 2, '0', STR_PAD_LEFT) . "-01"));

        $aktivitas = Aktivitas::with('anggotaDewan')->rentangTanggal($dari, $sampai);
        $rekapData = $this->buildRekapPerAnggota($aktivitas);

        return view('admin.rekap.index', array_merge($rekapData, [
            'judulPeriode' => 'Triwulan',
            'showTriwulan' => true,
            'triwulan'     => $triwulan,
            'tahun'        => $tahun,
        ]));
    }

    public function semester(Request $request)
    {
        $semester = $request->get('semester', date('n') <= 6 ? 1 : 2);
        $tahun    = $request->get('tahun', date('Y'));
        $dari     = $semester == 1 ? "{$tahun}-01-01" : "{$tahun}-07-01";
        $sampai   = $semester == 1 ? "{$tahun}-06-30" : "{$tahun}-12-31";

        $aktivitas = Aktivitas::with('anggotaDewan')->rentangTanggal($dari, $sampai);
        $rekapData = $this->buildRekapPerAnggota($aktivitas);

        return view('admin.rekap.index', array_merge($rekapData, [
            'judulPeriode' => 'Semester',
            'showSemester' => true,
            'semester'     => $semester,
            'tahun'        => $tahun,
        ]));
    }

    public function tahunan(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));

        $aktivitas = Aktivitas::with('anggotaDewan')->tahun($tahun);
        $rekapData = $this->buildRekapPerAnggota($aktivitas);

        return view('admin.rekap.index', array_merge($rekapData, [
            'judulPeriode' => 'Tahunan',
            'tahun'        => $tahun,
        ]));
    }

    private function buildRekapPerAnggota($query)
    {
        $clone = clone $query;
        $all   = $clone->get();

        $totalAktivitas = $all->count();
        $totalAnggotaAktif = $all->pluck('anggota_dewan_id')->unique()->count();

        $kategoriCounts = $all->groupBy('kategori')->map->count()->sortDesc();
        $kategoriTerbanyak = $kategoriCounts->isNotEmpty()
            ? (Aktivitas::semuaKategori()[$kategoriCounts->keys()->first()] ?? '-')
            : '-';

        $rekapPerAnggota = $all->groupBy('anggota_dewan_id')->map(function ($items) {
            return [
                'nama'  => $items->first()->anggotaDewan->nama_lengkap ?? 'N/A',
                'total' => $items->count(),
            ];
        })->sortByDesc('total')->values()->all();

        return compact('totalAktivitas', 'totalAnggotaAktif', 'kategoriTerbanyak', 'rekapPerAnggota');
    }
}
