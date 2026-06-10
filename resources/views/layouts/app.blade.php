<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Akademik Sederhana</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        :root {
            --primary-custom: #0d00c2;
        }
        body {
            background-color: #f4f6f9;
            font-family: 'Inter', sans-serif;
        }
        .bg-custom {
            background-color: var(--primary-custom) !important;
        }
        .btn-custom {
            background-color: var(--primary-custom);
            color: white;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #0a0099;
            color: white;
            transform: scale(1.05);
        }
        .text-custom {
            color: var(--primary-custom) !important;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .table-hover tbody tr:hover {
            background-color: rgba(13, 0, 194, 0.05);
        }
    </style>
</head>
<body>

    @auth
    <nav class="navbar navbar-expand-lg navbar-dark bg-custom animate__animated animate__fadeInDown">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">🎓 SisAkad</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('jurusan*') ? 'active fw-bold' : '' }}" href="{{ route('jurusan.index') }}">Jurusan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('mahasiswa*') ? 'active fw-bold' : '' }}" href="{{ route('mahasiswa.index') }}">Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('matakuliah*') ? 'active fw-bold' : '' }}" href="{{ route('matakuliah.index') }}">Matakuliah</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm rounded-pill px-4 animate__animated animate__pulse animate__infinite">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endauth

    <div class="container mt-5 mb-5">
        @if(session('success'))
            <div class="alert alert-success animate__animated animate__fadeInRight">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger animate__animated animate__shakeX">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
