<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasanuddin Dental Hospital Journal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @stack('styles')

</head>

<body>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Hasanuddin Dental Hospital Journal</h1>
        <p class="fs-5">Media Publikasi Penelitian dan Kajian Ilmiah di Bidang Kesehatan</p>
        <p>E-ISSN: xxxx-xxxx | P-ISSN: xxxx-xxxx</p>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
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
                    <li class="nav-item"><a class="nav-link btn btn-outline-light" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-light" href="{{ route('auth.register') }}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="content">
                    @yield('content')
                </div>
            </div>

            <div class="col-md-4">
                <div class="sidebar">
                    <h4 class="bg-secondary">Informasi</h4>
                    <a href="#">Focus and Scope</a>
                    <a href="#">Editorial Team</a>
                    <a href="#">Reviewer</a>
                    <a href="#">Peer Review Process</a>
                    <a href="#">Open Access Statement</a>
                    <a href="#">Publication Ethics</a>
                    <a href="#">Author Guidelines</a>
                    <a href="#">Plagiarism Screening</a>
                    <a href="#">Copyright Notice</a>
                    <a href="#">Author Fees</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <h5>Jurnal Kesehatan</h5>
            <p>Published by Rumah Sakit Gigi Dan Mulut Pendidikan Universitas Hasanuddin</p>
            <p>Email: <a href="mailto:rsgm.unhas@gmail.com">rsgm.unhas@gmail.com</a></p>
            <p>Contact: (0411) 3616336</p>
            <p>Alamat: Jl. Kandea No.5, Baraya, Kec. Bontoala, Kota Makassar, Sulawesi Selatan 90153</p>

            <img src="https://licensebuttons.net/l/by-nc-sa/3.0/88x31.png" alt="License">
            <p>This work is licensed under <a href="#">BY-NC-SA</a></p>

            <div class="mt-3">
                <iframe
                    width="100%"
                    height="400"
                    frameborder="0"
                    style="border:0"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.5049092018284!2d119.49716611476316!3d-5.170770996236955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbf1d53e71d6e8f%3A0xf4e8c5b4c9e01107!2sFakultas%20Kedokteran%20Dan%20Ilmu%20Kesehatan%20UIN%20Alauddin!5e0!3m2!1sen!2sid!4v1624465171087!5m2!1sen!2sid"
                    allowfullscreen></iframe>
            </div>

            <div class="mt-3">
                <script>
                    function initMap() {
                        var location = {
                            lat: -5.132115999999995,
                            lng: 119.49547022707361,
                        };
                        var map = new google.maps.Map(document.getElementById("map"), {
                            zoom: 15,
                            center: location,
                        });
                        var marker = new google.maps.Marker({
                            position: location,
                            map: map,
                            title: "Fakultas Kedokteran Dan Ilmu Kesehatan UIN Alauddin"
                        });
                    }
                </script>
            </div>

            <p>&copy; {{ date('Y') }} All Rights Reserved</p>
            <p>Platform and Workflow by OJS/PKP Version 3.1.2.4</p>
            <a href="#">Rumah Jurnal RSGMP Unhas</a> | <a href="#">About this Publishing System</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>