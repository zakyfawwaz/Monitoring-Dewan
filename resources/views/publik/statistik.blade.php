@extends('layouts.guest')
@section('title', 'Statistik')
@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-1"><i class="bi bi-bar-chart-fill text-success me-2"></i>Statistik Aktivitas</h2>
    <p class="text-muted mb-4">Ringkasan aktivitas Fraksi PKS DPRD Kota Tegal tahun {{ date('Y') }}</p>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="pub-card card p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-tags me-2 text-success"></i>Per Kategori</h6>
                @forelse($perKategori as $item)
                    @php $persen = $totalAktivitas > 0 ? round($item->total / $totalAktivitas * 100) : 0; @endphp
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span style="font-size:.82rem" class="fw-medium">{{ \App\Models\Aktivitas::semuaKategori()[$item->kategori] ?? $item->kategori }}</span>
                            <span style="font-size:.82rem" class="text-muted">{{ $item->total }} ({{ $persen }}%)</span>
                        </div>
                        <div class="progress" style="height:8px; border-radius:4px">
                            <div class="progress-bar bg-success" style="width:{{ $persen }}%; border-radius:4px"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Belum ada data.</p>
                @endforelse
            </div>
        </div>
        <div class="col-md-6">
            <div class="pub-card card p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-people me-2 text-primary"></i>Per Anggota Dewan</h6>
                @forelse($perAnggota as $item)
                    @php $persen = $totalAktivitas > 0 ? round($item->total / $totalAktivitas * 100) : 0; @endphp
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span style="font-size:.82rem" class="fw-medium">{{ $item->anggotaDewan->nama_lengkap ?? 'N/A' }}</span>
                            <span style="font-size:.82rem" class="text-muted">{{ $item->total }}</span>
                        </div>
                        <div class="progress" style="height:8px; border-radius:4px">
                            <div class="progress-bar bg-primary" style="width:{{ $persen }}%; border-radius:4px"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Belum ada data.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
