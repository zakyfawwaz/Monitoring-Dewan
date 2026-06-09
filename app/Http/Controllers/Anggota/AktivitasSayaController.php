<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use Illuminate\Http\Request;

class AktivitasSayaController extends Controller
{
    private function getAnggotaId()
    {
        return auth()->user()->anggota_dewan_id;
    }

    public function index()
    {
        $aktivitas = Aktivitas::milikAnggota($this->getAnggotaId())
            ->latest('tanggal')->latest('waktu')->paginate(15);
        return view('anggota.aktivitas.index', compact('aktivitas'));
    }

    public function create()
    {
        return view('anggota.aktivitas.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal'            => 'required|date',
            'waktu'              => 'required',
            'nama_kegiatan'      => 'required|string|max:255',
            'kategori'           => 'required|in:' . implode(',', array_keys(Aktivitas::semuaKategori())),
            'lokasi'             => 'required|string|max:255',
            'deskripsi_kegiatan' => 'nullable|string',
            'dokumentasi_foto'   => 'nullable|image|max:2048',
        ]);

        $data['anggota_dewan_id'] = $this->getAnggotaId();
        $data['dibuat_oleh'] = auth()->id();

        if ($request->hasFile('dokumentasi_foto')) {
            $data['dokumentasi_foto'] = $request->file('dokumentasi_foto')->store('aktivitas', 'public');
        }

        Aktivitas::create($data);
        return redirect()->route('anggota.aktivitas.index')->with('success', 'Aktivitas berhasil ditambahkan.');
    }

    public function show(Aktivitas $aktivitas)
    {
        return redirect()->route('anggota.aktivitas.edit', $aktivitas);
    }

    public function edit(Aktivitas $aktivitas)
    {
        abort_if($aktivitas->anggota_dewan_id !== $this->getAnggotaId(), 403);
        return view('anggota.aktivitas.form', compact('aktivitas'));
    }

    public function update(Request $request, Aktivitas $aktivitas)
    {
        abort_if($aktivitas->anggota_dewan_id !== $this->getAnggotaId(), 403);

        $data = $request->validate([
            'tanggal'            => 'required|date',
            'waktu'              => 'required',
            'nama_kegiatan'      => 'required|string|max:255',
            'kategori'           => 'required|in:' . implode(',', array_keys(Aktivitas::semuaKategori())),
            'lokasi'             => 'required|string|max:255',
            'deskripsi_kegiatan' => 'nullable|string',
            'dokumentasi_foto'   => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('dokumentasi_foto')) {
            $data['dokumentasi_foto'] = $request->file('dokumentasi_foto')->store('aktivitas', 'public');
        }

        $aktivitas->update($data);
        return redirect()->route('anggota.aktivitas.index')->with('success', 'Aktivitas berhasil diperbarui.');
    }

    public function destroy(Aktivitas $aktivitas)
    {
        abort_if($aktivitas->anggota_dewan_id !== $this->getAnggotaId(), 403);
        $aktivitas->delete();
        return redirect()->route('anggota.aktivitas.index')->with('success', 'Aktivitas berhasil dihapus.');
    }
}
