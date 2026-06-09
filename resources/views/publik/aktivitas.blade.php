@extends('layouts.guest')
@section('title', 'Aktivitas Publik')
@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-1"><i class="bi bi-calendar-event text-success me-2"></i>Aktivitas Anggota Dewan</h2>
    <p class="text-muted mb-4">Daftar kegiatan seluruh anggota Fraksi PKS DPRD Kota Tegal</p>

    {{-- Filter --}}
    <div class="pub-card card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-semibold" style="font-size:.82rem">Bulan</label>
                    <select name="bulan" class="form-select form-select-sm">
                        <option value="">Semua</option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold" style="font-size:.82rem">Kategori</label>
                    <select name="kategori" class="form-select form-select-sm">
                        <option value="">Semua</option>
                        @foreach(\App\Models\Aktivitas::semuaKategori() as $val => $label)
                            <option value="{{ $val }}" {{ request('kategori') == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold" style="font-size:.82rem">Cari</label>
                    <input type="text" name="cari" class="form-control form-control-sm" placeholder="Nama kegiatan..." value="{{ request('cari') }}">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-success btn-sm flex-grow-1"><i class="bi bi-search me-1"></i>Filter</button>
                    <a href="{{ route('publik.aktivitas') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                </div>
            </form>
        </div>
    </div>

    {{-- List --}}
    <div class="pub-card card">
        <div class="card-body p-0">
            @forelse($aktivitas as $akt)
                <div class="d-flex align-items-start gap-3 p-3 border-bottom">
                    <div class="text-center flex-shrink-0" style="width:50px">
                        <div class="fw-bold text-success" style="font-size:1.4rem">{{ $akt->tanggal->format('d') }}</div>
                        <div class="text-muted" style="font-size:.7rem">{{ $akt->tanggal->format('M Y') }}</div>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="fw-semibold mb-1" style="font-size:.9rem">{{ $akt->nama_kegiatan }}</h6>
                        <div class="d-flex flex-wrap gap-2 text-muted" style="font-size:.78rem">
                            <span><i class="bi bi-person me-1"></i>{{ $akt->anggotaDewan->nama_lengkap }}</span>
                            <span><i class="bi bi-clock me-1"></i>{{ $akt->waktu }}</span>
                            <span><i class="bi bi-geo-alt me-1"></i>{{ $akt->lokasi }}</span>
                        </div>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success badge-kategori">{{ $akt->label_kategori }}</span>
                </div>
            @empty
                <div class="p-5 text-center text-muted">
                    <i class="bi bi-inbox" style="font-size:2.5rem"></i>
                    <p class="mt-2">Tidak ada aktivitas ditemukan.</p>
                </div>
            @endforelse
        </div>
        @if($aktivitas->hasPages())
            <div class="card-footer bg-transparent p-3">{{ $aktivitas->withQueryString()->links() }}</div>
        @endif
    </div>
</div>
@endsection
