@extends('layouts.app')
@section('title', 'Laporan')
@section('page-title', 'Laporan')
@section('content')
<div class="card-clean card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-printer me-2 text-success"></i>Generate Laporan</span>
    </div>
    <div class="card-body p-4">
        <form method="GET" action="{{ route('admin.laporan.cetak') }}" target="_blank">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:.85rem">Dari Tanggal</label>
                    <input type="date" name="dari" class="form-control" value="{{ request('dari', now()->startOfMonth()->format('Y-m-d')) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:.85rem">Sampai Tanggal</label>
                    <input type="date" name="sampai" class="form-control" value="{{ request('sampai', now()->format('Y-m-d')) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:.85rem">Anggota</label>
                    <select name="anggota" class="form-select">
                        <option value="">Semua Anggota</option>
                        @foreach($daftarAnggota as $a)
                            <option value="{{ $a->id }}">{{ $a->nama_lengkap }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-success"><i class="bi bi-printer me-1"></i>Cetak Laporan</button>
            </div>
        </form>
    </div>
</div>
@endsection
