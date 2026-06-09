<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnggotaDewan;
use Illuminate\Http\Request;

class AnggotaDewanController extends Controller
{
    public function index()
    {
        return view('admin.anggota-dewan.index', [
            'anggota' => AnggotaDewan::latest()->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.anggota-dewan.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nikd'         => 'nullable|string|max:50|unique:anggota_dewans,nikd',
            'jabatan'      => 'required|string|max:100',
            'komisi'       => 'required|string|max:50',
            'nomor_hp'     => 'required|string|max:20',
            'status_aktif' => 'required|boolean',
            'foto'         => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        AnggotaDewan::create($data);
        return redirect()->route('admin.anggota-dewan.index')->with('success', 'Anggota dewan berhasil ditambahkan.');
    }

    public function show(AnggotaDewan $anggota_dewan)
    {
        return redirect()->route('admin.anggota-dewan.edit', $anggota_dewan);
    }

    public function edit(AnggotaDewan $anggota_dewan)
    {
        return view('admin.anggota-dewan.form', ['anggota' => $anggota_dewan]);
    }

    public function update(Request $request, AnggotaDewan $anggota_dewan)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nikd'         => 'nullable|string|max:50|unique:anggota_dewans,nikd,' . $anggota_dewan->id,
            'jabatan'      => 'required|string|max:100',
            'komisi'       => 'required|string|max:50',
            'nomor_hp'     => 'required|string|max:20',
            'status_aktif' => 'required|boolean',
            'foto'         => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        $anggota_dewan->update($data);
        return redirect()->route('admin.anggota-dewan.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(AnggotaDewan $anggota_dewan)
    {
        $anggota_dewan->delete();
        return redirect()->route('admin.anggota-dewan.index')->with('success', 'Anggota dewan berhasil dihapus.');
    }
}
