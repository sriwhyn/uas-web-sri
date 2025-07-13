<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Informasi Kampus PNP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            padding-top: 70px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm fixed-top" style="backdrop-filter: blur(10px); background-color: rgba(255,255,255,0.8);">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('beranda') }}">
            <i class="bi bi-building-fill-gear"></i> Info Kampus PNP
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <i class="bi bi-list fs-2 text-primary"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('beranda') ? 'active fw-bold text-primary' : '' }}" href="{{ route('beranda') }}">
                        <i class="bi bi-house-door me-1"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('event.semua') ? 'active fw-bold text-primary' : '' }}" href="{{ route('event.semua') }}">
                        <i class="bi bi-calendar-event me-1"></i> Event
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pengumuman.semua') ? 'active fw-bold text-primary' : '' }}" href="{{ route('pengumuman.semua') }}">
                        <i class="bi bi-megaphone-fill me-1"></i> Pengumuman
                    </a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-item-text text-muted small">{{ Auth::user()->email }}</li>
                            @if(Auth::user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-1"></i> Admin Panel
                                </a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-outline-primary rounded-pill px-3 py-1" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>


<!-- KONTEN UTAMA -->
<main>
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="bg-primary text-white text-center w-100 mt-5" style="padding: 3rem 0 2rem 0;">
    <div class="row justify-content-center mx-0 px-0">
        <h4 class="fw-bold mb-4">PUSAT INFORMASI KAMPUS PNP</h4>

        <div class="col-12 col-md-3 mb-3">
            <a href="tel:081292389075" class="text-decoration-none text-white d-block">
                <i class="bi bi-telephone-fill fs-3 d-block mb-2"></i>
                <strong>Telepon</strong><br>
                <span>0812 9238 9075</span>
            </a>
        </div>

        <div class="col-12 col-md-4 mb-3">
            <a href="mailto:whyn965@gmail.com" class="text-decoration-none text-white d-block">
                <i class="bi bi-envelope-fill fs-3 d-block mb-2"></i>
                <strong>Email</strong><br>
                <span>whyn965@gmail.com</span>
            </a>
        </div>

        <div class="col-12 col-md-4 mb-3">
            <a href="https://maps.google.com/?q=Politeknik+Negeri+Padang" target="_blank" class="text-decoration-none text-white d-block">
                <i class="bi bi-geo-alt-fill fs-3 d-block mb-2"></i>
                <strong>Lokasi</strong><br>
                <span>Politeknik Negeri Padang</span>
            </a>
        </div>
    </div>

    <div class="pt-3 mt-4 border-top border-white">
        <small class="text-white-50">
            &copy; {{ date('Y') }} <span class="fw-semibold text-white">Pusat Informasi Kampus PNP</span>. Dibuat oleh <span class="fw-semibold text-white">Sri Wahyuni</span>.
        </small>
    </div>
</footer>

<!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
