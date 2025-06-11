<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Titik Sampel</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body { background-color: #f8f9fa; }
    .card { border-radius: 1rem; margin-top: 2rem; }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
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
        </ul>
      </div>
    </div>
  </nav>

  <!-- Form Card -->
  <div class="container">
    <div class="card shadow-sm">
      <div class="card-header bg-white">
        <h3 class="card-title mb-0"><i class="fas fa-edit"></i> Edit Titik Sampel</h3>
      </div>
      <div class="card-body">
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('titiksampel.update', $titiksampel->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Titik</label>
            <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $titiksampel->nama) }}" required>
          </div>
          <div class="mb-3">
            <label for="longitude" class="form-label">Longitude</label>
            <input type="text" id="longitude" name="longitude" class="form-control" value="{{ old('longitude', $titiksampel->longitude) }}" required>
          </div>
          <div class="mb-3">
            <label for="latitude" class="form-label">Latitude</label>
            <input type="text" id="latitude" name="latitude" class="form-control" value="{{ old('latitude', $titiksampel->latitude) }}" required>
          </div>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Update
          </button>
          <a href="{{ route('titiksampel.index') }}" class="btn btn-secondary ms-2">
            <i class="fas fa-arrow-left"></i> Batal
          </a>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
