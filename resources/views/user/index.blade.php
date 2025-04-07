@extends('admin.templateAdmin')

<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/reviewer.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css" />
<script src="https://unpkg.com/@tailwindcss/browser@4"></script>

@section('content')
<div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="user-info">
                <div class="user-avatar">
                    <img src="{{ asset('images/default-profile.jpg') }}" alt="User Avatar">
                </div>
                <div class="user-details">
                    <h2>{{ Auth::user()->family_name }}</h2>
                    <p>{{ Auth::user()->role }}</p>
                </div>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('journals.dashboard') }}">Upload Journal</a></li>
            <!-- Tambahkan menu lainnya di sini -->
        </ul>
        <div class="sidebar-footer">
            <h4>Jurnal Kesehatan</h4>
            <p>ISSN (P) 2086-255X</p>
            <p>ISSN (E) 2022-7761</p>
            <hr>
            <h5>New Submission</h5>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="main-content">
        <nav class="navbar">
            <div>
                <h1>My Journal</h1>
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

        @if(session('success'))
        <div class="text-green-500 mb-4">{{ session('success') }}</div>
        @endif

        <div class="mb-4">
            <input type="text" id="searchInput" class="border p-2 w-full rounded-lg" placeholder="Cari berdasarkan judul atau penulis..." onkeyup="searchTable()">
        </div>

        <div class="overflow-x-auto">
            <table id="journalTable" class="w-full table-auto border-collapse border border-gray-300 shadow-lg rounded-lg">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="border border-gray-300 p-3">Judul</th>
                        <th class="border border-gray-300 p-3">Penulis</th>
                        <th class="border border-gray-300 p-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($journals as $journal)
                    <tr class="hover:bg-blue-100">
                        <td class="border border-gray-300 p-3">{{ $journal->title }}</td>
                        <td class="border border-gray-300 p-3">{{ $journal->authors }}</td>
                        <td class="border border-gray-300 p-3 text-center">
                            @if($status[$journal->status][0]->status == 'reject')
                            <button
                                onclick="showRejectionModal('{{ $journal->alasan_penolakan }}', '{{ $journal->rejection_reasons }}')"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full mb-2">
                                {{ $status[$journal->status][0]->status }}
                            </button>
                            @else
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full mb-2">
                                {{$status[$journal->status][0]->status}}
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Template -->
<div id="rejectionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-xl font-bold mb-4">Alasan Penolakan</h2>

        <!-- Custom Reason (Textarea) -->
        <div class="mb-4">
            <h3 class="font-semibold">Alasan Tambahan:</h3>
            <p id="rejectionReason" class="text-gray-700"></p>
        </div>

        <!-- Checkbox Reasons -->
        <div class="mb-4">
            <h3 class="font-semibold">Alasan dari Reviewer:</h3>
            <ul id="rejectionCheckboxReasons" class="list-disc pl-5 text-gray-700"></ul>
        </div>

        <button onclick="closeRejectionModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Tutup
        </button>
    </div>
</div>

<script>
    function showRejectionModal(customReason, checkboxReasonsJson) {
        // Tampilkan custom reason (textarea)
        const customReasonEl = document.getElementById('rejectionReason');
        customReasonEl.innerText = customReason || "Tidak ada alasan tambahan.";

        // Tampilkan checkbox reasons (jika ada)
        const checkboxReasonsEl = document.getElementById('rejectionCheckboxReasons');
        checkboxReasonsEl.innerHTML = ''; // Kosongkan list

        try {
            const checkboxReasons = JSON.parse(checkboxReasonsJson || '[]');

            if (checkboxReasons.length > 0) {
                checkboxReasons.forEach(reason => {
                    const li = document.createElement('li');
                    li.textContent = reason;
                    checkboxReasonsEl.appendChild(li);
                });
            } else {
                checkboxReasonsEl.innerHTML = '<li>Tidak ada alasan spesifik.</li>';
            }
        } catch (e) {
            console.error("Error parsing rejection_reasons:", e);
            checkboxReasonsEl.innerHTML = '<li>Format alasan tidak valid.</li>';
        }

        // Tampilkan modal
        document.getElementById('rejectionModal').classList.remove('hidden');
    }

    function closeRejectionModal() {
        document.getElementById('rejectionModal').classList.add('hidden');
        document.getElementById('rejectionModal').classList.remove('flex');
    }
</script>

<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("dropdown");
        dropdown.classList.toggle("hidden");
    }

    function openModal(journalId, pdfUrl) {
        var modal = document.getElementById("modal");
        var form = document.getElementById("accForm");
        var pdfViewer = document.getElementById("pdfViewer");
        form.action = `/journals/${journalId}/approve`;
        pdfViewer.src = pdfUrl;
        pdfViewer.style.width = "100%";
        pdfViewer.style.height = "100%";
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    }

    function closeModal() {
        var modal = document.getElementById("modal");
        modal.classList.add("hidden");
        modal.classList.remove("flex");
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