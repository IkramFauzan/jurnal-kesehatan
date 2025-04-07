@extends('auth.auth')

<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/reviewer.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css" />
<script src="https://unpkg.com/@tailwindcss/browser@4"></script>

@section('content')
<div class="container mt-4">
    <h3>Status Submission</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tanggal Upload</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($submissions as $submission)
            <tr>
                <td>{{ $submission->title }}</td>
                <td>{{ $submission->created_at }}</td>
                <td>
                    @if($submission->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($submission->status == 'under_review')
                        <span class="badge bg-info">Under Review</span>
                    @elseif($submission->status == 'accepted')
                        <span class="badge bg-success">Accepted</span>
                    @elseif($submission->status == 'rejected')
                        <span class="badge bg-danger">Rejected</span>
                    @elseif($submission->status == 'published')
                        <span class="badge bg-primary">Published</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection