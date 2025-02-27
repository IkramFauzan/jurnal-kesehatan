@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Jurnal Ilmu Komunikasi</h1>
    <p>Selamat datang di portal jurnal kami.</p>

    <h2>Jurnal Terbaru</h2>
    <ul>
        @foreach ($journals as $journal)
            <li>
                <a href="{{ route('journals.show', $journal->id) }}">{{ $journal->title }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
