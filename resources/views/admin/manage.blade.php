@extends('admin.templateAdmin')

<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css" />
<script src="https://unpkg.com/@tailwindcss/browser@4"></script>

@section('content')
<div class="dashboard-container">
    <!-- Sidebar di ujung kiri -->
    <div class="sidebar">
        <div class="sidebar-header">
            <!-- Wrapper untuk foto, username, dan role -->
            <div class="user-info">
                <div class="user-avatar">
                    <img src="{{ asset('images/default-profile.jpg') }}" alt="User Avatar">
                </div>
                <div class="user-details">
                    <h2>{{ Auth::user()->family_name }}</h2> <!-- Username pengguna yang sedang login -->
                    <p>{{ Auth::user()->role }}</p> <!-- Role pengguna yang sedang login -->
                </div>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.publish') }}">Publish Journal</a></li>
            <li><a href="{{ route('admin.manage') }}">Manage User</a></li>
        </ul>
    </div>

    <!-- Konten utama -->
    <div class="main-content">
        <nav class="navbar">
            <div>
                <h1>Welcome to your dashboard</h1>
            </div>
            <div class="user-dropdown">
                <span>{{ Auth::user()->username }}</span>
                <div class="dropdown-icon" onclick="toggleDropdown()">▼</div>
                <div id="dropdown" class="dropdown-menu">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stats-card">
                <p>Total Users</p>
                <span class="stats-percentage">+14%</span>
            </div>
            <div class="stats-card">
                <p>Total Journals</p>
                <span class="stats-percentage">+21%</span>
            </div>
            <div class="stats-card">
                <p>Total Reviewers</p>
                <span class="stats-percentage">+5%</span>
            </div>
            <div class="stats-card">
                <p>Total Admins</p>
                <span class="stats-percentage">+43%</span>
            </div>
        </div>

        <div class="manage-users-section">
            <h1>Kelola Pengguna</h1>
        </div>

        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="search-bar">
            <input type="text" id="searchInput" class="search-input" placeholder="Cari user..." onkeyup="searchTable()">
        </div>

        <div class="overflow-hidden rounded-lg shadow-lg">
            <table id="journalTable" class="w-full table-auto border-collapse border border-gray-300 shadow-lg rounded-lg">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="border border-gray-300 p-3">Nama Lengkap</th>
                        <th class="border border-gray-300 p-3">Email</th>
                        <th class="border border-gray-300 p-3">Role</th>
                        <th class="border border-gray-300 p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="hover:bg-blue-100">
                        @if($user-> role !== 'admin')
                        <td class="border border-gray-300 p-3">{{ $user->given_name }}</td>
                        <td class="border border-gray-300 p-3">{{ $user->email }}</td>
                        <td class="border border-gray-300 p-3">{{ $user->role }}</td>
                        <td class="border border-gray-300 p-3 text-center">
                            @if($user->role !== 'reviewer')
                            <button onclick="promoteUser('{{ $user->id }}')" class="promote-button">Promote to Reviewer</button>
                            @else
                            <span class="already-reviewer">Already Reviewer</span>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("dropdown");
        dropdown.style.display = dropdown.style.display === "none" ? "block" : "none";
    }

    function promoteUser(userId) {
        if (confirm('Are you sure you want to promote this user to reviewer?')) {
            fetch(`/admin/promote-user/${userId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }

    function searchTable() {
        var input = document.getElementById("searchInput").value.toLowerCase();
        var rows = document.querySelectorAll("#journalTable tbody tr");
        rows.forEach(function(row) {
            var title = row.cells[0].innerText.toLowerCase();
            var author = row.cells[1].innerText.toLowerCase();
            if (title.includes(input) || author.includes(input)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>
@endsection