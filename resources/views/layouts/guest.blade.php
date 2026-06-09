<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') — Monitoring DPRD PKS Tegal</title>
    <meta name="description" content="Sistem Monitoring Aktivitas Anggota Dewan Fraksi PKS DPRD Kota Tegal — Transparansi untuk masyarakat">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { 
            --pks-primary: #fe5000; 
            --pks-accent: #ff6b2b; 
            --pks-dark: #4d1800; 
            --bs-success: #fe5000;
            --bs-success-rgb: 254, 80, 0;
        }
        * { font-family: 'Inter', sans-serif; }
        body { background: #f8f9fa; }
        .badge.bg-success { color: #000 !important; }
        .btn-success { background-color: var(--pks-primary) !important; border-color: var(--pks-primary) !important; color: #fff !important; }
        .btn-success:hover { background-color: #e64800 !important; border-color: #e64800 !important; }
        .btn-outline-success { color: var(--pks-primary) !important; border-color: var(--pks-primary) !important; }
        .btn-outline-success:hover { background-color: var(--pks-primary) !important; border-color: var(--pks-primary) !important; color: #fff !important; }

        .navbar-pks {
            background: linear-gradient(135deg, var(--pks-dark), var(--pks-primary)) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,.15);
        }
        .navbar-pks .navbar-brand { font-weight: 700; font-size: 1rem; }
        .navbar-pks .nav-link { color: rgba(255,255,255,.8) !important; font-weight: 500; font-size: .88rem; transition: color .2s; }
        .navbar-pks .nav-link:hover, .navbar-pks .nav-link.active { color: #fff !important; }

        .hero-section {
            background: linear-gradient(135deg, var(--pks-dark) 0%, var(--pks-primary) 50%, var(--pks-accent) 100%);
            color: #fff; padding: 4rem 0 3rem; position: relative; overflow: hidden;
        }
        .hero-section::after {
            content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 60px;
            background: linear-gradient(transparent, #f8f9fa);
        }

        .pub-card {
            border: none; border-radius: 14px; background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,.06); transition: transform .2s, box-shadow .2s;
        }
        .pub-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,.1); }

        .footer-pks {
            background: var(--pks-dark); color: rgba(255,255,255,.6);
            padding: 2rem 0; font-size: .82rem;
        }

        .fade-in { animation: fadeIn .5s ease; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(10px) } to { opacity:1; transform:translateY(0) } }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-pks sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('beranda') }}">
                <i class="bi bi-building"></i> DPRD Kota Tegal — Fraksi PKS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navGuest">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navGuest">
                <ul class="navbar-nav ms-auto gap-1">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}"><i class="bi bi-house me-1"></i>Beranda</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('publik.aktivitas') ? 'active' : '' }}" href="{{ route('publik.aktivitas') }}"><i class="bi bi-calendar-event me-1"></i>Aktivitas</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('publik.statistik') ? 'active' : '' }}" href="{{ route('publik.statistik') }}"><i class="bi bi-bar-chart me-1"></i>Statistik</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('publik.laporan') ? 'active' : '' }}" href="{{ route('publik.laporan') }}"><i class="bi bi-file-earmark-text me-1"></i>Laporan</a></li>
                    <li class="nav-item ms-lg-2">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="fade-in">
        @yield('content')
    </main>

    <footer class="footer-pks">
        <div class="container text-center">
            <p class="mb-1">&copy; {{ date('Y') }} Fraksi PKS DPRD Kota Tegal. All rights reserved.</p>
            <p class="mb-0 opacity-50">Sistem Monitoring Aktivitas Anggota Dewan</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
