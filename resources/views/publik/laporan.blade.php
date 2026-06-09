@extends('layouts.guest')
@section('title', 'Laporan Publik')
@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-1"><i class="bi bi-file-earmark-bar-graph text-success me-2"></i>Laporan Publik</h2>
    <p class="text-muted mb-4">Ringkasan laporan aktivitas per bulan tahun {{ date('Y') }}</p>
    <div class="pub-card card">
        <div class="table-responsive">
            <table class="table table-clean mb-0">
                <thead>
                    <tr><th>Bulan</th><th class="text-center">Jumlah Aktivitas</th><th class="text-center">Anggota Aktif</th></tr>
                </thead>
                <tbody>
                    @foreach($laporanBulanan as $item)
                        <tr>
                            <td class="fw-medium">{{ \Carbon\Carbon::create()->month($item['bulan'])->translatedFormat('F') }}</td>
                            <td class="text-center"><span class="badge bg-success bg-opacity-10 text-success px-3">{{ $item['total'] }}</span></td>
                            <td class="text-center">{{ $item['anggota_aktif'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
