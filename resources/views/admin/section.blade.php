@extends('auth.auth')

@section('content')
<div class="container mt-5">
    <h2>Manage Sections</h2>

    <!-- Form untuk menambahkan Section -->
    <form action="{{ route('sections.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Section Name</label>
            <input type="text" name="section_name" class="form-control" placeholder="Enter Section Name" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Section</button>
    </form>

    <hr>

    <!-- List Section yang sudah ada -->
    <h4 class="mt-4">Existing Sections</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Section Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sections as $index => $section)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $section->section }}</td>
                <td>
                    <form action="{{ route('sections.destroy', $section->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection