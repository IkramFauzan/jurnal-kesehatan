<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Layout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #2e3a59;
            color: white;
            min-height: 100vh;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            font-size: 14px;
        }
        .sidebar a:hover {
            background-color: #47587d;
        }
        .sidebar .menu-title {
            text-transform: uppercase;
            font-size: 12px;
            margin: 20px 0 5px;
            padding: 0 20px;
            color: #a8b2d1;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f1f5f9;
        }
        .navbar {
            background-color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar .nav-icon {
            font-size: 20px;
            margin-left: 15px;
            cursor: pointer;
        }
        .navbar .user-menu {
            display: flex;
            align-items: center;
        }
        .navbar .user-menu img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-left: 10px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-center">Adminity</h4>
    <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="#"><i class="fas fa-chart-line"></i> Analytics</a>
    <div class="menu-title">UI Element</div>
    <a href="#"><i class="fas fa-cube"></i> Basic Components</a>
    <a href="#"><i class="fas fa-layer-group"></i> Advanced Components</a>
    <a href="#"><i class="fas fa-sticky-note"></i> Sticky Notes <span class="badge bg-danger">HOT</span></a>
    <div class="menu-title">Forms</div>
    <a href="#"><i class="fas fa-file-alt"></i> Form Components</a>
    <a href="#"><i class="fas fa-calendar-alt"></i> Form Picker <span class="badge bg-success">NEW</span></a>
</div>

<!-- Content -->
<div class="content">
    <!-- Navbar -->
    <div class="navbar">
        <div>
            <i class="fas fa-bars nav-icon"></i>
        </div>
        <div class="user-menu">
            <i class="fas fa-bell nav-icon"></i>
            <i class="fas fa-envelope nav-icon"></i>
            <img src="https://via.placeholder.com/30" alt="User">
        </div>
    </div>

    <!-- Main Content -->
    <div class="mt-4">
        @yield('content')
    </div>
</div>

</body>
</html>
