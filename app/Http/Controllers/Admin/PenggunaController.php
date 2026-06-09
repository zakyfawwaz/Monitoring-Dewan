<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnggotaDewan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        return view('admin.pengguna.index', [
            'pengguna' => User::with('anggotaDewan')->latest()->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.pengguna.form', [
            'daftarAnggota' => AnggotaDewan::aktif()->orderBy('nama_lengkap')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|string|min:6',
            'role'             => 'required|in:admin,anggota',
            'anggota_dewan_id' => 'nullable|exists:anggota_dewans,id',
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function show(User $pengguna)
    {
        return redirect()->route('admin.pengguna.edit', $pengguna);
    }

    public function edit(User $pengguna)
    {
        return view('admin.pengguna.form', [
            'pengguna'      => $pengguna,
            'daftarAnggota' => AnggotaDewan::aktif()->orderBy('nama_lengkap')->get(),
        ]);
    }

    public function update(Request $request, User $pengguna)
    {
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email,' . $pengguna->id,
            'password'         => 'nullable|string|min:6',
            'role'             => 'required|in:admin,anggota',
            'anggota_dewan_id' => 'nullable|exists:anggota_dewans,id',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $pengguna->update($data);
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $pengguna)
    {
        if ($pengguna->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }
        $pengguna->delete();
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
