@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/archive.css') }}">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

@endpush

@section('content')
<div class="container">
    <h2 class="mb-4">Archives</h2>
    @foreach ($archives as $archive)
        <div class="mb-3 p-3 border rounded shadow-sm">
            <h5><a href="#">{{ strtoupper($archive->journal_name) }}</a></h5>
            <p>Vol. {{ $archive->volume }}, No. {{ $archive->issue }} ({{ $archive->year }})</p>
            @if ($archive->description)
                <p>{{ $archive->description }}</p>
            @endif
            @if ($archive->cover_image)
                <img src="{{ $archive->cover_image }}" alt="Cover" width="120"> {{-- Langsung ambil dari DB --}}
            @endif
        </div>
    @endforeach
</div>
@endsection
