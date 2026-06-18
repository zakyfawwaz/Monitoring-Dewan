<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AktivitasStafAdministrasi;
use App\Models\StafAdministrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AktivitasStafAdministrasiController extends Controller
{
    public function index(Request $request)
    {
        $query = AktivitasStafAdministrasi::with('stafAdministrasi')->latest('tanggal')->latest('waktu');

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }
        if ($request->filled('kategori')) {
            $query->kategori($request->kategori);
        }
        if ($request->filled('staf_administrasi')) {
            $query->milikStaf($request->staf_administrasi);
        }

        return view('admin.aktivitas-staf-administrasi.index', [
            'aktivitas' => $query->get(),
            'daftarStaf' => StafAdministrasi::aktif()->orderBy('nama_lengkap')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.aktivitas-staf-administrasi.form', [
            'daftarStaf' => StafAdministrasi::aktif()->orderBy('nama_lengkap')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'staf_administrasi_id' => 'required|exists:staf_administrasi,id',
            'tanggal'              => 'required|date',
            'waktu'                => 'required',
            'nama_kegiatan'        => 'required|string|max:255',
            'kategori'             => 'required|in:' . implode(',', array_keys(AktivitasStafAdministrasi::semuaKategori())),
            'lokasi'               => 'required|string|max:255',
            'deskripsi_kegiatan'   => 'nullable|string',
            'dokumentasi_foto'     => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        $data['dibuat_oleh'] = auth()->id();

        if ($request->hasFile('dokumentasi_foto')) {
            $data['dokumentasi_foto'] = $request->file('dokumentasi_foto')->store('aktivitas_staf', 'public');
        }

        AktivitasStafAdministrasi::create($data);
        return redirect()->route('admin.aktivitas-staf-administrasi.index')->with('success', 'Aktivitas Staf Administrasi berhasil ditambahkan.');
    }

    public function show(AktivitasStafAdministrasi $aktivitas_staf_administrasi)
    {
        return redirect()->route('admin.aktivitas-staf-administrasi.edit', $aktivitas_staf_administrasi);
    }

    public function edit(AktivitasStafAdministrasi $aktivitas_staf_administrasi)
    {
        return view('admin.aktivitas-staf-administrasi.form', [
            'aktivitas'  => $aktivitas_staf_administrasi,
            'daftarStaf' => StafAdministrasi::aktif()->orderBy('nama_lengkap')->get(),
        ]);
    }

    public function update(Request $request, AktivitasStafAdministrasi $aktivitas_staf_administrasi)
    {
        $data = $request->validate([
            'staf_administrasi_id' => 'required|exists:staf_administrasi,id',
            'tanggal'              => 'required|date',
            'waktu'                => 'required',
            'nama_kegiatan'        => 'required|string|max:255',
            'kategori'             => 'required|in:' . implode(',', array_keys(AktivitasStafAdministrasi::semuaKategori())),
            'lokasi'               => 'required|string|max:255',
            'deskripsi_kegiatan'   => 'nullable|string',
            'dokumentasi_foto'     => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('dokumentasi_foto')) {
            if ($aktivitas_staf_administrasi->dokumentasi_foto && Storage::disk('public')->exists($aktivitas_staf_administrasi->dokumentasi_foto)) {
                Storage::disk('public')->delete($aktivitas_staf_administrasi->dokumentasi_foto);
            }
            $data['dokumentasi_foto'] = $request->file('dokumentasi_foto')->store('aktivitas_staf', 'public');
        }

        $aktivitas_staf_administrasi->update($data);
        return redirect()->route('admin.aktivitas-staf-administrasi.index')->with('success', 'Aktivitas Staf Administrasi berhasil diperbarui.');
    }

    public function destroy(AktivitasStafAdministrasi $aktivitas_staf_administrasi)
    {
        if ($aktivitas_staf_administrasi->dokumentasi_foto && Storage::disk('public')->exists($aktivitas_staf_administrasi->dokumentasi_foto)) {
            Storage::disk('public')->delete($aktivitas_staf_administrasi->dokumentasi_foto);
        }

        $aktivitas_staf_administrasi->delete();
        return redirect()->route('admin.aktivitas-staf-administrasi.index')->with('success', 'Aktivitas Staf Administrasi berhasil dihapus.');
    }
}
