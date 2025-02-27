@extends('layouts.app')

@section('content')
<h2>{{ $journal->title }}</h2>
<p><strong>Penulis:</strong> {{ $journal->author }}</p>
<p><strong>Abstrak:</strong> {{ $journal->abstract }}</p>
<a href="{{ asset('storage/' . $journal->file_path) }}" class="btn btn-success" target="_blank">Unduh PDF</a>
<a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
@endsection
