@extends('layouts.app')
@section('title', isset($pengguna) ? 'Edit Pengguna' : 'Tambah Pengguna')
@section('page-title', isset($pengguna) ? 'Edit Pengguna' : 'Tambah Pengguna')
@section('content')
<div class="row justify-content-center"><div class="col-lg-7">
    <div class="card-clean card">
        <div class="card-body p-4">
            <form method="POST" action="{{ isset($pengguna) ? route('admin.pengguna.update', $pengguna) : route('admin.pengguna.store') }}">
                @csrf
                @if(isset($pengguna)) @method('PUT') @endif
                <div class="row g-3">
                    <div class="col-12"><label class="form-label fw-semibold" style="font-size:.85rem">Nama</label><input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $pengguna->name ?? '') }}" required>@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label fw-semibold" style="font-size:.85rem">Email</label><input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $pengguna->email ?? '') }}" required>@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label fw-semibold" style="font-size:.85rem">Password {{ isset($pengguna) ? '(kosongkan jika tidak diubah)' : '' }}</label><input type="password" name="password" class="form-control @error('password') is-invalid @enderror" {{ isset($pengguna) ? '' : 'required' }}>@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label fw-semibold" style="font-size:.85rem">Role</label>
                        <select name="role" class="form-select" required><option value="admin" {{ old('role', $pengguna->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option><option value="anggota" {{ old('role', $pengguna->role ?? '') == 'anggota' ? 'selected' : '' }}>Anggota Dewan</option></select>
                    </div>
                    <div class="col-md-6"><label class="form-label fw-semibold" style="font-size:.85rem">Link Anggota Dewan</label>
                        <select name="anggota_dewan_id" class="form-select"><option value="">-- Tidak ada --</option>
                            @foreach($daftarAnggota as $a)<option value="{{ $a->id }}" {{ old('anggota_dewan_id', $pengguna->anggota_dewan_id ?? '') == $a->id ? 'selected' : '' }}>{{ $a->nama_lengkap }}</option>@endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4"><button class="btn btn-success px-4"><i class="bi bi-check-lg me-1"></i>Simpan</button><a href="{{ route('admin.pengguna.index') }}" class="btn btn-outline-secondary">Batal</a></div>
            </form>
        </div>
    </div>
</div></div>
@endsection
