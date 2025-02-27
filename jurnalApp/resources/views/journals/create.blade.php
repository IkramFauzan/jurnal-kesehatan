@extends('layouts.app')

@section('content')
<h2>Tambah Jurnal</h2>

<form action="{{ route('journals.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Penulis</label>
        <input type="text" name="author" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="abstract" class="form-label">Abstrak</label>
        <textarea name="abstract" class="form-control" rows="5" required></textarea>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">Upload PDF</label>
        <input type="file" name="file" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('home') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
