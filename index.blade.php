<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Titik Sampel</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.1/dist/leaflet.css"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .navbar {
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .card {
      border-radius: 1rem;
      border: none;
      overflow: hidden;
    }
    .card-header {
      background-color: #ffffff;
      border-bottom: 1px solid #e3e6f0;
    }
    .card-title {
      font-weight: 600;
      font-size: 1.1rem;
    }
    .table-card {
      max-height: 280px;
      overflow-y: auto;
    }
    .table thead th {
      font-weight: 600;
      font-size: 0.95rem;
    }
    .table tbody td {
      vertical-align: middle;
      font-size: 0.9rem;
    }
    .table-hover tbody tr:hover {
      background-color: #f1f3f5;
    }
    .leaflet-container {
      width: 100%;
      height: 800px;
      border-radius: 0 0 1rem 1rem;
    }
    footer {
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
      box-shadow: 0 -2px 5px rgba(0,0,0,0.05);
      font-size: 0.9rem;
    }
    .alert {
      border-radius: 0.5rem;
      font-size: 0.9rem;
    }
    .btn {
      font-size: 0.85rem;
      padding: 0.35rem 0.6rem;
      border-radius: 0.3rem;
    }
    .btn i {
      margin-right: 0.2rem;
    }
    .navbar-brand, .nav-link {
      font-weight: 600;
      font-size: 0.95rem;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
      <a class="navbar-brand" href="{{ route('titiksampel.index') }}">
        <i class="fas fa-map-marked-alt"></i> Sistem GIS Titik Sampel
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('titiksampel.index') }}">
              <i class="fas fa-home"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('titiksampel.create') }}">
              <i class="fas fa-plus"></i> Tambah Titik
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Container -->
  <div class="container">
    <!-- Tabel di Atas -->
    <div class="card shadow-sm mb-4 table-card">
      <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-table"></i> Daftar Titik Sampel</h5>
      </div>
      <div class="card-body p-0">
        @if(session('success'))
          <div class="alert alert-success m-3">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
          </div>
        @endif
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>Nama</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($titiksampel as $t)
              <tr>
                <td>{{ $t->nama }}</td>
                <td>{{ $t->longitude }}</td>
                <td>{{ $t->latitude }}</td>
                <td>
                  <a href="{{ route('titiksampel.edit', $t->id) }}" class="btn btn-sm btn-warning me-1">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('titiksampel.destroy', $t->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                      <i class="fas fa-trash"></i> Hapus
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Peta di Bawah -->
    <div class="card shadow-sm mb-4">
      <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-globe"></i> Peta Sebaran Titik</h5>
      </div>
      <div class="card-body p-0">
        <div id="map" class="leaflet-container"></div>
      </div>
    </div>
  </div>

  <!-- Bootstrap & Leaflet JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.1/dist/leaflet.js"></script>

  <script>
    var map = L.map('map').setView([-7.0, 110.0], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    @foreach($titiksampel as $t)
      @if($t->latitude && $t->longitude)
        L.marker([{{ $t->latitude }}, {{ $t->longitude }}])
          .addTo(map)
          .bindPopup('<strong>{{ $t->nama }}</strong><br>Lat: {{ $t->latitude }}<br>Lng: {{ $t->longitude }}');
      @endif
    @endforeach
  </script>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-4">
    © 2025 Sistem GIS Titik Sampel | Dibangun dengan Laravel & Leaflet
  </footer>

</body>
</html>
