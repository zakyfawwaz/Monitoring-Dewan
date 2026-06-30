@extends('layouts.app')
@section('title', 'Rekap ' . $judulPeriode)
@section('page-title', 'Rekap ' . $judulPeriode)
@section('content')
<div class="card-clean card mb-3">
    <div class="card-body py-2 px-3">
        <form method="GET" class="row g-2 align-items-center">
            <div class="col-auto me-3">
                <div class="btn-group btn-group-sm" role="group">
                    <input type="radio" class="btn-check" name="jenis" id="jenisDewan" value="dewan" {{ $jenis == 'dewan' ? 'checked' : '' }} onchange="this.form.submit()">
                    <label class="btn btn-outline-success" for="jenisDewan">Dewan</label>
                    <input type="radio" class="btn-check" name="jenis" id="jenisTasa" value="tasa" {{ $jenis == 'tasa' ? 'checked' : '' }} onchange="this.form.submit()">
                    <label class="btn btn-outline-success" for="jenisTasa">TA/SA</label>
                </div>
            </div>
            @if(isset($showBulan))
                <div class="col-auto">
                    <select name="bulan" class="form-select form-select-sm">
                        @for($i=1;$i<=12;$i++)
                            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                        @endfor
                    </select>
                </div>
            @endif
            @if(isset($showTriwulan))
                <div class="col-auto">
                    <select name="triwulan" class="form-select form-select-sm">
                        <option value="1" {{ ($triwulan ?? 1) == 1 ? 'selected' : '' }}>Triwulan I (Jan-Mar)</option>
                        <option value="2" {{ ($triwulan ?? 1) == 2 ? 'selected' : '' }}>Triwulan II (Apr-Jun)</option>
                        <option value="3" {{ ($triwulan ?? 1) == 3 ? 'selected' : '' }}>Triwulan III (Jul-Sep)</option>
                        <option value="4" {{ ($triwulan ?? 1) == 4 ? 'selected' : '' }}>Triwulan IV (Okt-Des)</option>
                    </select>
                </div>
            @endif
            @if(isset($showSemester))
                <div class="col-auto">
                    <select name="semester" class="form-select form-select-sm">
                        <option value="1" {{ ($semester ?? 1) == 1 ? 'selected' : '' }}>Semester I (Jan-Jun)</option>
                        <option value="2" {{ ($semester ?? 1) == 2 ? 'selected' : '' }}>Semester II (Jul-Des)</option>
                    </select>
                </div>
            @endif
            <div class="col-auto">
                <select name="tahun" class="form-select form-select-sm">
                    @for($y = 2029; $y >= 2024; $y--)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-auto"><button class="btn btn-success btn-sm"><i class="bi bi-filter me-1"></i>Filter</button></div>
        </form>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card card p-3 text-center">
            <div class="stat-value text-success">{{ $totalAktivitas }}</div>
            <div class="stat-label">Total Aktivitas</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card card p-3 text-center">
            <div class="stat-value text-primary">{{ $totalAnggotaAktif }}</div>
            <div class="stat-label">{{ $jenis == 'tasa' ? 'TA/SA Aktif' : 'Anggota Aktif' }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card card p-3 text-center">
            <div class="stat-value text-warning">{{ $kategoriTerbanyak }}</div>
            <div class="stat-label">Kategori Terbanyak</div>
        </div>
    </div>
</div>

<div class="card-clean card">
    <div class="card-header"><i class="bi bi-table me-2 text-success"></i>Detail Per {{ $jenis == 'tasa' ? 'TA/SA' : 'Anggota' }}</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-clean table-hover mb-0">
                <thead><tr><th>#</th><th>Nama {{ $jenis == 'tasa' ? 'TA/SA' : 'Anggota' }}</th><th class="text-center">Jumlah Aktivitas</th></tr></thead>
                <tbody>
                    @forelse($rekapPerAnggota as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="fw-medium">{{ $item['nama'] }}</td>
                            <td class="text-center"><span class="badge bg-success bg-opacity-10 text-success px-3">{{ $item['total'] }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center py-4 text-muted">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
