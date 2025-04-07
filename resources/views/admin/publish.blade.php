@extends('admin.templateAdmin')

<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/reviewer.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css" />
<script src="https://unpkg.com/@tailwindcss/browser@4"></script>

@section('content')
<div class="dashboard-container">
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

        <div class="manage-users-section">
            <h1>Publish Journal</h1>
        </div>

        <div class="search-bar">
                <input type="text" id="searchInput" class="search-input" placeholder="Cari jurnal..." onkeyup="searchTable()">
        </div>

        @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
        @endif

        <div class="overflow-hidden rounded-lg shadow-lg">
            <table id="journalTable" class="w-full table-auto border-collapse border border-gray-300 shadow-lg rounded-lg">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="border border-gray-300 p-3">Judul</th>
                        <th class="border border-gray-300 p-3">Penulis</th>
                        <th class="border border-gray-300 p-3">Status</th>
                        <th class="border border-gray-300 p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($journals as $journal)
                    <tr class="hover:bg-blue-100">
                        <td class="border border-gray-300 p-3">{{ $journal->title }}</td>
                        <td class="border border-gray-300 p-3">{{ $journal->authors }}</td>
                        <td class="border border-gray-300 p-3">{{ $journal->status }}</td>
                        <td class="border border-gray-300 p-3 text-center">
                            <button onclick="openModal('{{ $journal->id }}', '{{ asset($journal->file_path) }}')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mb-2">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                        </td>
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