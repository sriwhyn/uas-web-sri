<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Webinar Sri</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

  <!-- Navbar Atas -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">Admin - Webinar Sri</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active text-white' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2 me-1"></i> Dashboard
          </a>
          <a class="nav-link {{ request()->is('admin/kategori*') ? 'active text-white' : '' }}" href="{{ route('admin.kategori.index') }}">
            <i class="bi bi-tags me-1"></i> Kategori
          </a>
          <a class="nav-link {{ request()->is('admin/event*') ? 'active text-white' : '' }}" href="{{ route('admin.event.index') }}">
            <i class="bi bi-calendar-event me-1"></i> Event
          </a>
          <a class="nav-link {{ request()->is('admin/pengumuman*') ? 'active text-white' : '' }}" href="{{ route('admin.pengumuman.index') }}">
            <i class="bi bi-megaphone me-1"></i> Pengumuman
          </a>
          <a class="nav-link {{ request()->is('admin/pendaftaran*') ? 'active text-white' : '' }}" href="{{ route('admin.pendaftaran.index') }}">
            <i class="bi bi-people me-1"></i> Pendaftaran
          </a>
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><span class="dropdown-item-text text-muted small">{{ Auth::user()->email }}</span></li>
              <li><a class="dropdown-item" href="{{ route('beranda') }}">Lihat Website</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="dropdown-item">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                  </button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Konten Halaman -->
  <main class="container py-4">
    @yield('content')
  </main>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
