@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
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
                {{ $article->subtitle }}
            </h5>
            <p>{{ $article->authors }}</p>
            <p>Pages: {{ $article->pages }}</p>

            <a href="{{ route('article.view', ['id' => $article->id, 't' => time()]) }}" target="_blank" class="view-pdf" data-id="{{ $article->id }}">👁 View PDF</a>
            <a href="{{ route('article.download-pdf', ['id' => $article->id, 't' => time()]) }}" class="download-pdf" data-id="{{ $article->id }}">📥 Download PDF</a>

            <p>
                🔗 <a href="{{ $article->doi_link }}" target="_blank">
                    {{ $article->doi_link }}
                </a>
            </p>

            {{-- Statistik View dan Download --}}
            <p>
                👁 Views: <span id="views-{{ $article->id }}">{{ $article->views }}</span>
                | 📥 PDF Downloads: <span id="downloads-{{ $article->id }}">{{ $article->downloads }}</span>
            </p>
        </div>
    </div>
    @endforeach
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event delegation for view PDF links
        document.querySelectorAll('.view-pdf').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const articleId = this.getAttribute('data-id');
                fetch(`/article/view/${articleId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById(`views-${articleId}`).innerText = data.views;
                        window.open(this.href, '_blank');
                    });
            });
        });

        // Event delegation for download PDF links
        document.querySelectorAll('.download-pdf').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const articleId = this.getAttribute('data-id');
                fetch(`/article/download-pdf/${articleId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById(`downloads-${articleId}`).innerText = data.downloads;
                        window.location.href = this.href;
                    });
            });
        });
    });
</script>
@endpush