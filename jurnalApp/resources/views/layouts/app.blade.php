<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Ilmu Komunikasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @stack('styles')

    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .navbar {
            border-radius: 16px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .navbar-dark .navbar-nav .nav-link {
            color: white;
            font-weight: bold;
        }
        .sidebar {
            background: #1e73be;
            color: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 12px;
            margin-bottom: 5px;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background: #155a8a;
        }
        .content {
            background: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>JURNAL ILMU KOMUNIKASI</h1>
        <p>E-ISSN: - | P-ISSN: -</p>
        <p>Alamat Redaksi : </p>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('journals.home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('journals.about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('journals.search') }}">Search</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('journals.current') }}">Current</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('journals.archives') }}">Archives</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('journals.announcements') }}">Announcements</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('journals.contact') }}">Contact</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link btn btn-outline-light mx-2" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-warning" href="{{ route('auth.register') }}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 mr-8 content ps-4">
                @yield('content')
            </div>
            <div class="col-md-4 sidebar">
                <h4>Menu</h4>
                <a href="#">FOCUS AND SCOPE</a>
                <a href="#">EDITORIAL TEAM</a>
                <a href="#">REVIEWER</a>
                <a href="#">PEER REVIEW PROCESS</a>
                <a href="#">OPEN ACCESS STATEMENT</a>
                <a href="#">PUBLICATION ETHICS</a>
                <a href="#">AUTHOR GUIDELINES</a>
                <a href="#">PLAGIARISM SCREENING</a>
                <a href="#">COPYRIGHT NOTICE</a>
                <a href="#">AUTHOR FEES</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
