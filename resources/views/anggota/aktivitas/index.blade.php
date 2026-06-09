@extends('layouts.app')
@section('title', 'Aktivitas Saya')
@section('page-title', 'Aktivitas Saya')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-muted mb-0" style="font-size:.85rem">Daftar aktivitas yang Anda input</p>
    <a href="{{ route('anggota.aktivitas.create') }}" class="btn btn-success btn-sm px-3" style="border-radius:8px"><i class="bi bi-plus-lg me-1"></i> Tambah Aktivitas</a>
</div>
<div class="card-clean card">
    <div class="card-body p-0 table-responsive">
        <table class="table table-clean table-hover mb-0">
            <thead><tr><th>#</th><th>Tanggal</th><th>Kegiatan</th><th>Kategori</th><th>Lokasi</th><th class="text-center">Aksi</th></tr></thead>
            <tbody>
                @forelse($aktivitas as $i => $akt)
                    <tr>
                        <td>{{ $aktivitas->firstItem() + $i }}</td>
                        <td style="white-space:nowrap">{{ $akt->tanggal->format('d/m/Y') }}<br><small class="text-muted">{{ $akt->waktu }}</small></td>
                        <td class="fw-medium">{{ $akt->nama_kegiatan }}</td>
                        <td><span class="badge bg-success bg-opacity-10 text-success badge-kategori">{{ $akt->label_kategori }}</span></td>
                        <td>{{ $akt->lokasi }}</td>
                        <td class="text-center">
                            <a href="{{ route('anggota.aktivitas.edit', $akt) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada aktivitas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($aktivitas->hasPages())<div class="card-footer bg-transparent p-3">{{ $aktivitas->withQueryString()->links() }}</div>@endif
</div>
@endsection
