<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use Illuminate\Http\Request;

class RekapSayaController extends Controller
{
    private function getAnggotaId()
    {
        return auth()->user()->anggota_dewan_id;
    }

    public function bulanan(Request $request)
    {
        $bulan = $request->get('bulan', date('n'));
        $tahun = $request->get('tahun', date('Y'));
        $total = Aktivitas::milikAnggota($this->getAnggotaId())->bulan($bulan, $tahun)->count();
        $perKategori = Aktivitas::milikAnggota($this->getAnggotaId())->bulan($bulan, $tahun)
            ->selectRaw('kategori, COUNT(*) as total')->groupBy('kategori')->orderByDesc('total')->get();

        return view('admin.rekap.index', [
            'judulPeriode'     => 'Bulanan (Saya)',
            'showBulan'        => true,
            'bulan'            => $bulan,
            'tahun'            => $tahun,
            'totalAktivitas'   => $total,
            'totalAnggotaAktif' => $total > 0 ? 1 : 0,
            'kategoriTerbanyak' => $perKategori->isNotEmpty() ? (Aktivitas::semuaKategori()[$perKategori->first()->kategori] ?? '-') : '-',
            'rekapPerAnggota'  => $perKategori->map(fn($i) => ['nama' => Aktivitas::semuaKategori()[$i->kategori] ?? $i->kategori, 'total' => $i->total])->values()->all(),
        ]);
    }

    public function triwulan(Request $request) { return $this->bulanan($request); }
    public function semester(Request $request) { return $this->bulanan($request); }
    public function tahunan(Request $request) { return $this->bulanan($request); }
}
