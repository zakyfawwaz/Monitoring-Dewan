@extends('layouts.app')
@section('title', 'Dashboard Anggota')
@section('page-title', 'Dashboard')
@section('content')
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="stat-card card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="bi bi-calendar-check-fill"></i></div>
                <div><div class="stat-value">{{ $aktivitasHariIni }}</div><div class="stat-label">Hari Ini</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="stat-card card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="bi bi-calendar3"></i></div>
                <div><div class="stat-value">{{ $aktivitasBulanIni }}</div><div class="stat-label">Bulan Ini</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-xl-4">
        <div class="stat-card card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-graph-up"></i></div>
                <div><div class="stat-value">{{ $aktivitasTahunIni }}</div><div class="stat-label">Tahun {{ date('Y') }}</div></div>
            </div>
        </div>
    </div>
</div>

<div class="card-clean card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-clock-history text-success me-2"></i>Aktivitas Terbaru Saya</span>
        <a href="{{ route('anggota.aktivitas.create') }}" class="btn btn-sm btn-success"><i class="bi bi-plus-lg me-1"></i>Tambah</a>
    </div>
    <div class="card-body p-0">
        @forelse($aktivitasTerbaru as $akt)
            <div class="d-flex align-items-center gap-3 p-3 border-bottom">
                <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center flex-shrink-0" style="width:38px;height:38px">
                    <i class="bi bi-calendar-event text-success" style="font-size:.85rem"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold" style="font-size:.85rem">{{ $akt->nama_kegiatan }}</div>
                    <div class="text-muted" style="font-size:.75rem">{{ $akt->tanggal->format('d M Y') }} · {{ $akt->lokasi }}</div>
                </div>
                <span class="badge bg-success bg-opacity-10 text-success badge-kategori">{{ $akt->label_kategori }}</span>
            </div>
        @empty
            <div class="p-4 text-center text-muted"><i class="bi bi-inbox" style="font-size:1.5rem"></i><p class="mt-2 mb-0">Belum ada aktivitas.</p></div>
        @endforelse
    </div>
</div>
@endsection
