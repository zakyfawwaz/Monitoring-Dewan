@extends('layouts.guest')
@section('title', 'Login')
@section('content')
<div style="min-height:75vh" class="d-flex align-items-center justify-content-center py-5">
    <div class="card border-0 shadow-lg" style="border-radius:16px; max-width:420px; width:100%;">
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-4">
                <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width:60px;height:60px">
                    <i class="bi bi-shield-lock-fill text-success" style="font-size:1.5rem"></i>
                </div>
                <h4 class="fw-bold mb-1">Masuk ke Sistem</h4>
                <p class="text-muted" style="font-size:.85rem">Monitoring DPRD PKS Kota Tegal</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger py-2 px-3" style="border-radius:10px; font-size:.85rem; border:none; background:rgba(220,53,69,.1); color:#dc3545;">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.proses') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:.85rem">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                        <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="email@example.com" value="{{ old('email') }}" required autofocus style="font-size:.9rem">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold" style="font-size:.85rem">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                        <input type="password" name="password" class="form-control border-start-0 ps-0" placeholder="••••••••" required style="font-size:.9rem">
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100 py-2 fw-semibold" style="border-radius:10px; background:linear-gradient(135deg, #1B5E20, #4CAF50); border:none;">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('beranda') }}" class="text-muted text-decoration-none" style="font-size:.82rem">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
