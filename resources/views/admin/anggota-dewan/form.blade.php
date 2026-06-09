@extends('layouts.app')
@section('title', isset($anggota) ? 'Edit Anggota' : 'Tambah Anggota')
@section('page-title', isset($anggota) ? 'Edit Anggota Dewan' : 'Tambah Anggota Dewan')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-clean card">
            <div class="card-header"><i class="bi bi-person-plus me-2 text-success"></i>{{ isset($anggota) ? 'Edit Data' : 'Data Baru' }}</div>
            <div class="card-body p-4">
                <form method="POST" action="{{ isset($anggota) ? route('admin.anggota-dewan.update', $anggota) : route('admin.anggota-dewan.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if(isset($anggota)) @method('PUT') @endif

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold" style="font-size:.85rem">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap', $anggota->nama_lengkap ?? '') }}" required>
                            @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size:.85rem">NIKD</label>
                            <input type="text" name="nikd" class="form-control @error('nikd') is-invalid @enderror" value="{{ old('nikd', $anggota->nikd ?? '') }}">
                            @error('nikd')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.85rem">Jabatan <span class="text-danger">*</span></label>
                            <select name="jabatan" class="form-select @error('jabatan') is-invalid @enderror" required>
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach(['Ketua Fraksi','Wakil Ketua Fraksi','Sekretaris Fraksi','Anggota'] as $j)
                                    <option value="{{ $j }}" {{ old('jabatan', $anggota->jabatan ?? '') == $j ? 'selected' : '' }}>{{ $j }}</option>
                                @endforeach
                            </select>
                            @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.85rem">Komisi <span class="text-danger">*</span></label>
                            <select name="komisi" class="form-select @error('komisi') is-invalid @enderror" required>
                                <option value="">-- Pilih Komisi --</option>
                                @foreach(['Komisi I','Komisi II','Komisi III','Wakil Ketua DPRD'] as $k)
                                    <option value="{{ $k }}" {{ old('komisi', $anggota->komisi ?? '') == $k ? 'selected' : '' }}>{{ $k }}</option>
                                @endforeach
                            </select>
                            @error('komisi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.85rem">Nomor HP <span class="text-danger">*</span></label>
                            <input type="text" name="nomor_hp" class="form-control @error('nomor_hp') is-invalid @enderror" value="{{ old('nomor_hp', $anggota->nomor_hp ?? '') }}" required>
                            @error('nomor_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.85rem">Status</label>
                            <select name="status_aktif" class="form-select">
                                <option value="1" {{ old('status_aktif', $anggota->status_aktif ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status_aktif', $anggota->status_aktif ?? 1) == 0 ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:.85rem">Foto</label>
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                            @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-success px-4"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                        <a href="{{ route('admin.anggota-dewan.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
