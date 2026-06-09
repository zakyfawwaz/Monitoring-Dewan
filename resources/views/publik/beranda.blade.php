@extends('layouts.guest')
@section('title', 'Beranda')
@section('content')
{{-- Hero --}}
<section class="hero-section text-center">
    <div class="container position-relative" style="z-index:1">
        <h1 class="display-5 fw-bold mb-3">Monitoring Aktivitas<br>Anggota Dewan</h1>
        <p class="lead opacity-75 mx-auto" style="max-width:600px">Transparansi kegiatan Fraksi PKS DPRD Kota Tegal untuk pelayanan masyarakat yang lebih baik.</p>
        <div class="d-flex gap-3 justify-content-center mt-4">
            <a href="{{ route('publik.aktivitas') }}" class="btn btn-light btn-lg px-4 fw-semibold" style="border-radius:12px;font-size:.9rem">
                <i class="bi bi-calendar-event me-1"></i> Lihat Aktivitas
            </a>
            <a href="{{ route('publik.statistik') }}" class="btn btn-outline-light btn-lg px-4 fw-semibold" style="border-radius:12px;font-size:.9rem">
                <i class="bi bi-bar-chart me-1"></i> Statistik
            </a>
        </div>
    </div>
</section>

<div class="container py-5">
    {{-- Stats --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="pub-card card p-4 text-center">
                <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width:56px;height:56px">
                    <i class="bi bi-people-fill text-success" style="font-size:1.4rem"></i>
                </div>
                <h3 class="fw-bold text-dark">{{ $totalAnggota }}</h3>
                <p class="text-muted mb-0" style="font-size:.85rem">Anggota Dewan Aktif</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="pub-card card p-4 text-center">
                <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width:56px;height:56px">
                    <i class="bi bi-calendar-check-fill text-primary" style="font-size:1.4rem"></i>
                </div>
                <h3 class="fw-bold text-dark">{{ $totalAktivitas }}</h3>
                <p class="text-muted mb-0" style="font-size:.85rem">Total Aktivitas {{ date('Y') }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="pub-card card p-4 text-center">
                <div class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width:56px;height:56px">
                    <i class="bi bi-activity text-warning" style="font-size:1.4rem"></i>
                </div>
                <h3 class="fw-bold text-dark">{{ $aktivitasBulanIni }}</h3>
                <p class="text-muted mb-0" style="font-size:.85rem">Aktivitas Bulan Ini</p>
            </div>
        </div>
    </div>

    {{-- Aktivitas Terbaru --}}
    <div class="pub-card card">
        <div class="card-header bg-transparent border-bottom p-3">
            <h5 class="fw-bold mb-0"><i class="bi bi-clock-history text-success me-2"></i>Aktivitas Terbaru</h5>
        </div>
        <div class="card-body p-0">
            @forelse($aktivitasTerbaru as $akt)
                <div class="d-flex align-items-start gap-3 p-3 border-bottom">
                    <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center flex-shrink-0" style="width:42px;height:42px">
                        <i class="bi bi-calendar-event text-success"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="fw-semibold mb-1" style="font-size:.9rem">{{ $akt->nama_kegiatan }}</h6>
                        <div class="d-flex flex-wrap gap-2 text-muted" style="font-size:.78rem">
                            <span><i class="bi bi-person me-1"></i>{{ $akt->anggotaDewan->nama_lengkap }}</span>
                            <span><i class="bi bi-calendar me-1"></i>{{ $akt->tanggal->format('d M Y') }}</span>
                            <span><i class="bi bi-geo-alt me-1"></i>{{ $akt->lokasi }}</span>
                        </div>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success badge-kategori">{{ $akt->label_kategori }}</span>
                </div>
            @empty
                <div class="p-4 text-center text-muted">
                    <i class="bi bi-inbox" style="font-size:2rem"></i>
                    <p class="mt-2 mb-0">Belum ada aktivitas tercatat.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
