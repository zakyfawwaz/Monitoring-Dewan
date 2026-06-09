@extends('layouts.app')
@section('title', 'Manajemen Pengguna')
@section('page-title', 'Manajemen Pengguna')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-muted mb-0" style="font-size:.85rem">Kelola akun pengguna sistem</p>
    <a href="{{ route('admin.pengguna.create') }}" class="btn btn-success btn-sm px-3" style="border-radius:8px"><i class="bi bi-plus-lg me-1"></i> Tambah Pengguna</a>
</div>
<div class="card-clean card">
    <div class="card-body p-0 table-responsive">
        <table class="table table-clean table-hover mb-0">
            <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>Role</th><th>Anggota Dewan</th><th class="text-center">Aksi</th></tr></thead>
            <tbody>
                @forelse($pengguna as $i => $u)
                    <tr>
                        <td>{{ $pengguna->firstItem() + $i }}</td>
                        <td class="fw-medium">{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td><span class="badge {{ $u->role == 'admin' ? 'bg-danger' : 'bg-primary' }} bg-opacity-10 {{ $u->role == 'admin' ? 'text-danger' : 'text-primary' }}">{{ ucfirst($u->role) }}</span></td>
                        <td>{{ $u->anggotaDewan->nama_lengkap ?? '-' }}</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.pengguna.edit', $u) }}" class="btn btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                @if($u->id !== auth()->id())
                                    <form action="{{ route('admin.pengguna.destroy', $u) }}" method="POST" onsubmit="return confirm('Hapus pengguna?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada pengguna.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pengguna->hasPages())<div class="card-footer bg-transparent p-3">{{ $pengguna->links() }}</div>@endif
</div>
@endsection
