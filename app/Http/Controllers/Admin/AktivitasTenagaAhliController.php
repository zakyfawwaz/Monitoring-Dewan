<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AktivitasTenagaAhli;
use App\Models\TenagaAhli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AktivitasTenagaAhliController extends Controller
{
    public function index(Request $request)
    {
        $query = AktivitasTenagaAhli::with('tenagaAhli')->latest('tanggal')->latest('waktu');

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }
        if ($request->filled('kategori')) {
            $query->kategori($request->kategori);
        }
        if ($request->filled('tenaga_ahli')) {
            $query->milikTenagaAhli($request->tenaga_ahli);
        }

        return view('admin.aktivitas-tenaga-ahli.index', [
            'aktivitas' => $query->get(),
            'daftarTenagaAhli' => TenagaAhli::aktif()->orderBy('nama_lengkap')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.aktivitas-tenaga-ahli.form', [
            'daftarTenagaAhli' => TenagaAhli::aktif()->orderBy('nama_lengkap')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tenaga_ahli_id'     => 'required|exists:tenaga_ahli,id',
            'tanggal'            => 'required|date',
            'waktu'              => 'required',
            'nama_kegiatan'      => 'required|string|max:255',
            'kategori'           => 'required|in:' . implode(',', array_keys(AktivitasTenagaAhli::semuaKategori())),
            'lokasi'             => 'required|string|max:255',
            'deskripsi_kegiatan' => 'nullable|string',
            'dokumentasi_foto'   => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        $data['dibuat_oleh'] = auth()->id();

        if ($request->hasFile('dokumentasi_foto')) {
            $data['dokumentasi_foto'] = $request->file('dokumentasi_foto')->store('aktivitas_ta', 'public');
        }

        AktivitasTenagaAhli::create($data);
        return redirect()->route('admin.aktivitas-tenaga-ahli.index')->with('success', 'Aktivitas Tenaga Ahli berhasil ditambahkan.');
    }

    public function show(AktivitasTenagaAhli $aktivitas_tenaga_ahli)
    {
        return redirect()->route('admin.aktivitas-tenaga-ahli.edit', $aktivitas_tenaga_ahli);
    }

    public function edit(AktivitasTenagaAhli $aktivitas_tenaga_ahli)
    {
        return view('admin.aktivitas-tenaga-ahli.form', [
            'aktivitas'        => $aktivitas_tenaga_ahli,
            'daftarTenagaAhli' => TenagaAhli::aktif()->orderBy('nama_lengkap')->get(),
        ]);
    }

    public function update(Request $request, AktivitasTenagaAhli $aktivitas_tenaga_ahli)
    {
        $data = $request->validate([
            'tenaga_ahli_id'     => 'required|exists:tenaga_ahli,id',
            'tanggal'            => 'required|date',
            'waktu'              => 'required',
            'nama_kegiatan'      => 'required|string|max:255',
            'kategori'           => 'required|in:' . implode(',', array_keys(AktivitasTenagaAhli::semuaKategori())),
            'lokasi'             => 'required|string|max:255',
            'deskripsi_kegiatan' => 'nullable|string',
            'dokumentasi_foto'   => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('dokumentasi_foto')) {
            if ($aktivitas_tenaga_ahli->dokumentasi_foto && Storage::disk('public')->exists($aktivitas_tenaga_ahli->dokumentasi_foto)) {
                Storage::disk('public')->delete($aktivitas_tenaga_ahli->dokumentasi_foto);
            }
            $data['dokumentasi_foto'] = $request->file('dokumentasi_foto')->store('aktivitas_ta', 'public');
        }

        $aktivitas_tenaga_ahli->update($data);
        return redirect()->route('admin.aktivitas-tenaga-ahli.index')->with('success', 'Aktivitas Tenaga Ahli berhasil diperbarui.');
    }

    public function destroy(AktivitasTenagaAhli $aktivitas_tenaga_ahli)
    {
        if ($aktivitas_tenaga_ahli->dokumentasi_foto && Storage::disk('public')->exists($aktivitas_tenaga_ahli->dokumentasi_foto)) {
            Storage::disk('public')->delete($aktivitas_tenaga_ahli->dokumentasi_foto);
        }

        $aktivitas_tenaga_ahli->delete();
        return redirect()->route('admin.aktivitas-tenaga-ahli.index')->with('success', 'Aktivitas Tenaga Ahli berhasil dihapus.');
    }
}
