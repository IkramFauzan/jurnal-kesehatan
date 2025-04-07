@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $article->title }}</h1>
    <iframe src="{{ asset('uploads/' . $article->file_name) }}" width="100%" height="600px"></iframe>
    <a href="{{ route('article.download', $article->id) }}" class="btn btn-primary mt-3">📥 Download PDF</a>
</div>
@endsection