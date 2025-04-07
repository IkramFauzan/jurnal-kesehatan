@extends('admin.templateAdmin')

<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/reviewer.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
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

        <h1 class="text-2xl font-bold mb-4">Review Journal</h1>

        @if(session('success'))
        <div class="text-green-500 mb-4">{{ session('success') }}</div>
        @endif

        <div class="mb-4">
            <input type="text" id="searchInput" class="border p-2 w-full rounded-lg" placeholder="Cari berdasarkan judul atau penulis..." onkeyup="searchTable()">
        </div>

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
                            <button onclick="openModal('{{ $journal->id }}', '{{ Storage::url($journal->file_path) }}')"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mb-2 transition duration-300">
                                <i class="fa fa-eye" aria-hidden="true"></i> Lihat
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Utama (Review PDF) -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-40">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full h-full max-w-6xl max-h-screen overflow-hidden flex flex-col">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Konfirmasi Review</h2>
            <button onclick="closeModal()" class="text-red-500 text-xl font-bold">✖</button>
        </div>
        <iframe id="pdfViewer" class="w-full h-full flex-grow overflow-auto" frameborder="0"></iframe>
        <div class="mt-4 flex justify-end gap-4">
            <button onclick="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Batal</button>
            <form id="accForm" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Setuju</button>
            </form>
            <button onclick="openRejectModal()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Tolak</button>
        </div>
    </div>
</div>

<!-- Modal Tolak (Alasan Penolakan) -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-bold mb-4">Alasan Penolakan</h2>
        <div class="space-y-2 mb-4">
            <div class="flex items-center">
                <input type="checkbox" id="structureIssue" name="reasons[]" value="Struktur Jurnal" class="mr-2">
                <label for="structureIssue">Struktur Jurnal</label>
            </div>
            <div class="flex items-center">
                <input type="checkbox" id="referenceIssue" name="reasons[]" value="Daftar Pustaka Kurang" class="mr-2">
                <label for="referenceIssue">Daftar Pustaka Kurang</label>
            </div>
            <div class="flex items-center">
                <input type="checkbox" id="writingIssue" name="reasons[]" value="Penulisan Salah" class="mr-2">
                <label for="writingIssue">Penulisan Salah</label>
            </div>
        </div>
        <textarea id="rejectReason" name="custom_reason" class="border p-2 w-full rounded-lg" placeholder="Masukkan alasan penolakan lainnya..."></textarea>
        <div class="mt-4 flex justify-end gap-4">
            <button type="button" onclick="closeRejectModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Batal</button>
            <form id="rejectForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="rejection_reasons" id="hiddenReasons">
                <input type="hidden" name="custom_reason" id="hiddenCustomReason">
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Kirim</button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("dropdown");
        dropdown.classList.toggle("hidden");
    }

    // function openModal(journalId, pdfUrl) {
    //     var modal = document.getElementById("modal");
    //     var form = document.getElementById("accForm");
    //     var rejectForm = document.getElementById("rejectForm");
    //     var pdfViewer = document.getElementById("pdfViewer");
    //     form.action = `/journals/${journalId}/approve`;
    //     rejectForm.action = `/journals/${journalId}/reject`;
    //     pdfViewer.src = pdfUrl;
    //     modal.classList.remove("hidden");
    //     modal.classList.add("flex");
    // }

    let currentJournalId = null; // Simpan ID jurnal yang sedang direview

    function openModal(journalId, pdfUrl) {
        currentJournalId = journalId; 

        if (!pdfUrl.startsWith('http') && !pdfUrl.startsWith('/storage/')) {
            pdfUrl = '/storage/' + pdfUrl.replace(/^storage\//, '');
        }

        const pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.src = pdfUrl + '#toolbar=0&navpanes=0&scrollbar=0';

        document.getElementById('accForm').action = `/journals/${journalId}/approve`;
        document.getElementById('rejectForm').action = `/journals/${journalId}/reject`;

        document.getElementById('modal').classList.remove('hidden');

        pdfViewer.onerror = () => {
            alert('Gagal memuat dokumen. Pastikan file tersedia.');
            closeModal();
        };
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
        document.getElementById('pdfViewer').src = '';
    }

    function openRejectModal() {
        if (!currentJournalId) {
            alert("Tidak ada jurnal yang dipilih!");
            return;
        }

        document.querySelectorAll('input[name="reasons[]"]').forEach(checkbox => {
            checkbox.checked = false;
        });
        document.getElementById('rejectReason').value = '';

        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
    }

    document.getElementById("rejectForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const checkboxes = document.querySelectorAll('input[name="reasons[]"]:checked');
        const reasons = Array.from(checkboxes).map(cb => cb.value);

        const customReason = document.getElementById("rejectReason").value.trim();

        document.getElementById("hiddenReasons").value = JSON.stringify(reasons);
        document.getElementById("hiddenCustomReason").value = customReason;

        this.submit();
    });

    function closeModal() {
        var modal = document.getElementById("modal");
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    }

    function openRejectModal() {
        document.getElementById("rejectModal").classList.remove("hidden");
    }

    function closeRejectModal() {
        document.getElementById("rejectModal").classList.add("hidden");
    }

    // document.getElementById("rejectForm").onsubmit = function() {
    //     document.getElementById("hiddenReason").value = document.getElementById("rejectReason").value;
    // };


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