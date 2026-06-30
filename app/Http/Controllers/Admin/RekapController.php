<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\AnggotaDewan;
use App\Models\AktivitasTenagaAhli;
use App\Models\AktivitasStafAdministrasi;
use App\Models\TenagaAhli;
use App\Models\StafAdministrasi;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function bulanan(Request $request)
    {
        $jenis = $request->get('jenis', 'dewan');
        $bulan = $request->get('bulan', date('n'));
        $tahun = $request->get('tahun', date('Y'));

        if ($jenis === 'tasa') {
            $ta = AktivitasTenagaAhli::with('tenagaAhli')->bulan($bulan, $tahun)->get();
            $sa = AktivitasStafAdministrasi::with('stafAdministrasi')->bulan($bulan, $tahun)->get();
            $rekapData = $this->buildRekapTasa($ta, $sa);
        } else {
            $aktivitas = Aktivitas::with('anggotaDewan')->bulan($bulan, $tahun);
            $rekapData = $this->buildRekapPerAnggota($aktivitas);
        }

        return view('admin.rekap.index', array_merge($rekapData, [
            'judulPeriode' => 'Bulanan',
            'showBulan'    => true,
            'bulan'        => $bulan,
            'tahun'        => $tahun,
            'jenis'        => $jenis,
        ]));
    }

    public function triwulan(Request $request)
    {
        $jenis    = $request->get('jenis', 'dewan');
        $triwulan = $request->get('triwulan', ceil(date('n') / 3));
        $tahun    = $request->get('tahun', date('Y'));
        $dari     = "{$tahun}-" . str_pad(($triwulan - 1) * 3 + 1, 2, '0', STR_PAD_LEFT) . "-01";
        $sampai   = date('Y-m-t', strtotime("{$tahun}-" . str_pad($triwulan * 3, 2, '0', STR_PAD_LEFT) . "-01"));

        if ($jenis === 'tasa') {
            $ta = AktivitasTenagaAhli::with('tenagaAhli')->rentangTanggal($dari, $sampai)->get();
            $sa = AktivitasStafAdministrasi::with('stafAdministrasi')->rentangTanggal($dari, $sampai)->get();
            $rekapData = $this->buildRekapTasa($ta, $sa);
        } else {
            $aktivitas = Aktivitas::with('anggotaDewan')->rentangTanggal($dari, $sampai);
            $rekapData = $this->buildRekapPerAnggota($aktivitas);
        }

        return view('admin.rekap.index', array_merge($rekapData, [
            'judulPeriode' => 'Triwulan',
            'showTriwulan' => true,
            'triwulan'     => $triwulan,
            'tahun'        => $tahun,
            'jenis'        => $jenis,
        ]));
    }

    public function semester(Request $request)
    {
        $jenis    = $request->get('jenis', 'dewan');
        $semester = $request->get('semester', date('n') <= 6 ? 1 : 2);
        $tahun    = $request->get('tahun', date('Y'));
        $dari     = $semester == 1 ? "{$tahun}-01-01" : "{$tahun}-07-01";
        $sampai   = $semester == 1 ? "{$tahun}-06-30" : "{$tahun}-12-31";

        if ($jenis === 'tasa') {
            $ta = AktivitasTenagaAhli::with('tenagaAhli')->rentangTanggal($dari, $sampai)->get();
            $sa = AktivitasStafAdministrasi::with('stafAdministrasi')->rentangTanggal($dari, $sampai)->get();
            $rekapData = $this->buildRekapTasa($ta, $sa);
        } else {
            $aktivitas = Aktivitas::with('anggotaDewan')->rentangTanggal($dari, $sampai);
            $rekapData = $this->buildRekapPerAnggota($aktivitas);
        }

        return view('admin.rekap.index', array_merge($rekapData, [
            'judulPeriode' => 'Semester',
            'showSemester' => true,
            'semester'     => $semester,
            'tahun'        => $tahun,
            'jenis'        => $jenis,
        ]));
    }

    public function tahunan(Request $request)
    {
        $jenis = $request->get('jenis', 'dewan');
        $tahun = $request->get('tahun', date('Y'));

        if ($jenis === 'tasa') {
            $ta = AktivitasTenagaAhli::with('tenagaAhli')->tahun($tahun)->get();
            $sa = AktivitasStafAdministrasi::with('stafAdministrasi')->tahun($tahun)->get();
            $rekapData = $this->buildRekapTasa($ta, $sa);
        } else {
            $aktivitas = Aktivitas::with('anggotaDewan')->tahun($tahun);
            $rekapData = $this->buildRekapPerAnggota($aktivitas);
        }

        return view('admin.rekap.index', array_merge($rekapData, [
            'judulPeriode' => 'Tahunan',
            'tahun'        => $tahun,
            'jenis'        => $jenis,
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

    private function buildRekapTasa($taCollection, $saCollection)
    {
        // Standarisasi relasi
        $ta = $taCollection->map(function ($item) {
            $item->pelaku_id   = 'TA_' . $item->tenaga_ahli_id;
            $item->pelaku_nama = $item->tenagaAhli->nama_lengkap ?? 'N/A';
            return $item;
        });

        $sa = $saCollection->map(function ($item) {
            $item->pelaku_id   = 'SA_' . $item->staf_administrasi_id;
            $item->pelaku_nama = $item->stafAdministrasi->nama_lengkap ?? 'N/A';
            return $item;
        });

        $all = $ta->concat($sa);

        $totalAktivitas    = $all->count();
        $totalAnggotaAktif = $all->pluck('pelaku_id')->unique()->count();

        $kategoriCounts = $all->groupBy('kategori')->map->count()->sortDesc();
        // Karena kategori TA/SA berbeda (ada OPD, konstituen, dll), kita ambil dari group keys
        $kategoriTerbanyak = $kategoriCounts->isNotEmpty()
            ? ucfirst($kategoriCounts->keys()->first())
            : '-';

        $rekapPerAnggota = $all->groupBy('pelaku_id')->map(function ($items) {
            return [
                'nama'  => $items->first()->pelaku_nama,
                'total' => $items->count(),
            ];
        })->sortByDesc('total')->values()->all();

        return compact('totalAktivitas', 'totalAnggotaAktif', 'kategoriTerbanyak', 'rekapPerAnggota');
    }
}
