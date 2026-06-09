<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\AnggotaDewan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index', [
            'daftarAnggota' => AnggotaDewan::aktif()->orderBy('nama_lengkap')->get(),
        ]);
    }

    public function cetak(Request $request)
    {
        $dari   = $request->get('dari', now()->startOfMonth()->format('Y-m-d'));
        $sampai = $request->get('sampai', now()->format('Y-m-d'));

        $query = Aktivitas::with('anggotaDewan')->rentangTanggal($dari, $sampai)->orderBy('tanggal');

        if ($request->filled('anggota')) {
            $query->milikAnggota($request->anggota);
        }

        return view('admin.laporan.cetak', [
            'aktivitas' => $query->get(),
            'dari'      => $dari,
            'sampai'    => $sampai,
        ]);
    }

    public function exportPdf()
    {
        return redirect()->route('admin.laporan.index')->with('error', 'Fitur export PDF akan segera tersedia.');
    }

    public function exportExcel()
    {
        return redirect()->route('admin.laporan.index')->with('error', 'Fitur export Excel akan segera tersedia.');
    }
}
