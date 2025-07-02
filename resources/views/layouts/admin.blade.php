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

<body>

  <div class="d-flex" style="min-height: 100vh;">

    <!-- Sidebar -->
    <nav class="bg-dark text-white p-3" style="width: 250px;">
      <h5 class="fw-bold mb-4"><i class="bi bi-grid-fill me-2"></i>Admin Panel</h5>
      <ul class="nav flex-column">
        <li class="nav-item mb-2">
          <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'fw-bold' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white {{ request()->is('admin/kategori*') ? 'fw-bold' : '' }}" href="{{ route('admin.kategori.index') }}">
            <i class="bi bi-tags me-2"></i> Kategori
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white {{ request()->is('admin/event*') ? 'fw-bold' : '' }}" href="{{ route('admin.event.index') }}">
            <i class="bi bi-calendar-event me-2"></i> Event
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white {{ request()->is('admin/pengumuman*') ? 'fw-bold' : '' }}" href="{{ route('admin.pengumuman.index') }}">
            <i class="bi bi-megaphone me-2"></i> Pengumuman
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white {{ request()->is('admin/pendaftaran*') ? 'fw-bold' : '' }}" href="{{ route('admin.pendaftaran.index') }}">
            <i class="bi bi-people me-2"></i> Pendaftaran
          </a>
        </li>
        <li class="nav-item mt-3">
          <a class="nav-link text-white" href="{{ route('beranda') }}">
            <i class="bi bi-house me-2"></i> Lihat Website
          </a>
        </li>
        <li class="nav-item mt-2">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-light btn-sm w-100">
              <i class="bi bi-box-arrow-right me-2"></i>Logout
            </button>
          </form>
        </li>
      </ul>
    </nav>

    <!-- Main Content -->
    <div class="flex-grow-1 bg-light">
      <!-- Navbar atas -->
      <nav class="navbar navbar-light bg-white shadow-sm px-4">
        <div class="container-fluid justify-content-end">
          <span class="navbar-text text-muted">
            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
          </span>
        </div>
      </nav>

      <!-- Konten -->
      <main class="p-4">
        @yield('content')
      </main>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>