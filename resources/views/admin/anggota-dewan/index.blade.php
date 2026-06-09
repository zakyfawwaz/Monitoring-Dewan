@extends('layouts.app')
@section('title', 'Data Anggota Dewan')
@section('page-title', 'Data Anggota Dewan')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <p class="text-muted mb-0" style="font-size:.85rem">Kelola data anggota dewan Fraksi PKS</p>
    </div>
    <a href="{{ route('admin.anggota-dewan.create') }}" class="btn btn-success btn-sm px-3" style="border-radius:8px">
        <i class="bi bi-plus-lg me-1"></i> Tambah Anggota
    </a>
</div>
<div class="card-clean card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-clean table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:40px">#</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th>Komisi</th>
                        <th>No. HP</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width:120px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggota as $i => $a)
                        <tr>
                            <td>{{ $anggota->firstItem() + $i }}</td>
                            <td class="fw-semibold">{{ $a->nama_lengkap }}</td>
                            <td>{{ $a->jabatan }}</td>
                            <td>{{ $a->komisi }}</td>
                            <td>{{ $a->nomor_hp }}</td>
                            <td class="text-center">
                                <span class="badge {{ $a->status_aktif ? 'bg-success' : 'bg-secondary' }} bg-opacity-10 {{ $a->status_aktif ? 'text-success' : 'text-secondary' }}">
                                    {{ $a->status_aktif ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-1 justify-content-center">
                                    <a href="{{ route('admin.anggota-dewan.edit', $a) }}" class="btn btn-outline-warning btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.anggota-dewan.destroy', $a) }}" method="POST" class="m-0 p-0" onsubmit="return confirm('Hapus anggota ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada data anggota dewan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($anggota->hasPages())
        <div class="card-footer bg-transparent p-3">{{ $anggota->links() }}</div>
    @endif
</div>
@endsection
