@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold">Jurnal Kesehatan</h2>
    <p class="justify">
        Jurnal Kesehatan is an academic journal that publishes medical and health scientific articles.
        We regularly publish the issues in <strong>June</strong> and <strong>December</strong>.
        <strong>The journal accepts research-based papers, literature/health research regarding pharmacy, nursing, public science, and midwifery.</strong>
        This journal was published by the Medical and Health Science Faculty, Universitas Islam Negeri Alauddin Makassar.
    </p>
    <p class="justify">
        The journal has been accredited by Akreditasi Jurnal Nasional (ARJUNA) officially managed by the Ministry of Research Technology and Higher Education,
        Republic Indonesia <strong>Nomor 23/E/KPT/2019</strong> with the <strong>SINTA 3</strong> grade from 2019 to 2024.
    </p>

    <div class="text-center my-4">
        <img src="https://journal.uin-alauddin.ac.id/public/site/images/reza/New_Project.png" alt="Sertifikat Akreditasi" class="img-fluid shadow rounded">
    </div>

    <h3 class="text-success fw-bold mt-5">Current Issue</h3>
    <h5>Vol 1 No 2: Jurnal Kesehatan</h5>
    <p><strong>PUBLISHED:</strong> 2024-12-27</p>

    @foreach($journals as $article)
    <div class="mt-4">
        <div class="mb-4">
            <h5 class="fw-bold text-primary">
                {{ $article->title }}
            </h5>
            <p><em>{{ $article->subtitle }}</em></p>
            <p>{{ $article->authors }}</p>
            <p>Pages: {{ $article->pages }}</p>

            <!-- Tombol View PDF dengan Modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#pdfModal-{{ $article->id }}">
                👁 View PDF
            </button>

            <!-- Tombol Download PDF -->
            <a href="{{ route('article.download-pdf', ['id' => $article->id, 't' => time()]) }}" class="btn btn-primary" id="download-btn-{{ $article->id }}">
                📥 Download PDF
            </a>

            <p>
                🔗 <a href="{{ $article->doi_link }}" target="_blank">
                    {{ $article->doi_link }}
                </a>
            </p>

            <!-- Statistik View dan Download -->
            <p>
                👁 Views: <span id="views-{{ $article->id }}">{{ $article->views }}</span>
                | 📥 PDF Downloads: <span id="downloads-{{ $article->id }}">{{ $article->downloads }}</span>
            </p>
        </div>
    </div>

    <!-- Modal untuk View PDF -->
    <div class="modal fade" id="pdfModal-{{ $article->id }}" tabindex="-1" aria-labelledby="pdfModalLabel-{{ $article->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel-{{ $article->id }}">{{ $article->title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Embed PDF di dalam modal -->
                    <iframe src="{{ route('article.view', $article->id) }}" width="100%" height="500px"></iframe>
                </div>
                <div class="modal-footer">
                    <!-- Tombol Download di dalam modal -->
                    <a href="{{ route('article.download-pdf', ['id' => $article->id, 't' => time()]) }}" class="btn btn-primary">
                        📥 Download PDF
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- AJAX untuk Update Views Secara Real-Time -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Update views secara real-time
            fetch("{{ route('article.view', $article->id) }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById("views-{{ $article->id }}").innerText = data.views;
                });

            // Update downloads secara real-time
            document.getElementById("download-btn-{{ $article->id }}").addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah default behavior dari link

                fetch("{{ route('article.download-pdf', $article->id) }}")
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("downloads-{{ $article->id }}").innerText = data.downloads;
                        // Redirect ke file PDF setelah download dihitung
                        window.location.href = "{{ route('article.download-pdf', $article->id) }}";
                    });
            });
        });
    </script>
    @endforeach
</div>

<!-- Bootstrap JS dan dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection