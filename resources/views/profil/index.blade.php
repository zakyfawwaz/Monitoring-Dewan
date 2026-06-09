@extends('layouts.app')
@section('title', 'Profil')
@section('page-title', 'Profil Saya')
@section('content')
<div class="row g-4 justify-content-center">
    <div class="col-lg-6">
        <div class="card-clean card">
            <div class="card-header"><i class="bi bi-person me-2 text-success"></i>Ubah Profil</div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('profil.update') }}">
                    @csrf @method('PUT')
                    <div class="mb-3"><label class="form-label fw-semibold" style="font-size:.85rem">Nama</label><input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name) }}" required>@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <div class="mb-3"><label class="form-label fw-semibold" style="font-size:.85rem">Email</label><input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email) }}" required>@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <button class="btn btn-success"><i class="bi bi-check-lg me-1"></i>Simpan Profil</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-clean card">
            <div class="card-header"><i class="bi bi-lock me-2 text-warning"></i>Ubah Password</div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('profil.password') }}">
                    @csrf @method('PUT')
                    <div class="mb-3"><label class="form-label fw-semibold" style="font-size:.85rem">Password Lama</label><input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>@error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <div class="mb-3"><label class="form-label fw-semibold" style="font-size:.85rem">Password Baru</label><input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <div class="mb-3"><label class="form-label fw-semibold" style="font-size:.85rem">Konfirmasi Password</label><input type="password" name="password_confirmation" class="form-control" required></div>
                    <button class="btn btn-warning"><i class="bi bi-lock me-1"></i>Ubah Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
