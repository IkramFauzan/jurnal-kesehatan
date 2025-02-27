@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

@section('content')
<div class="container">
    <h2>Search</h2>
    <form action="{{ route('journals.search') }}" method="GET">
        <div class="mb-3">
            <label for="search" class="form-label">Search for</label>
            <input type="text" name="q" id="search" class="form-control">
        </div>

        <h4>Search categories</h4>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Authors">
            <input type="text" class="form-control mt-2" placeholder="Title">
            <input type="text" class="form-control mt-2" placeholder="Abstract">
            <input type="text" class="form-control mt-2" placeholder="Full Text">
            <input type="text" class="form-control mt-2" placeholder="Supplementary File(s)">
        </div>

        <h4>Publication Date</h4>
        <div class="mb-3">
            <label>From:</label>
            <input type="date" class="form-control">
            <label class="mt-2">Until:</label>
            <input type="date" class="form-control">
        </div>

        <h4>Index terms</h4>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Discipline(s)">
            <input type="text" class="form-control mt-2" placeholder="Keyword(s)">
            <input type="text" class="form-control mt-2" placeholder="Type (method/approach)">
            <input type="text" class="form-control mt-2" placeholder="Coverage">
            <input type="text" class="form-control mt-2" placeholder="All index term fields">
        </div>

        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <h4 class="mt-4">Search tips:</h4>
    <ul>
        <li>Search terms are case-insensitive</li>
        <li>Common words are ignored</li>
        <li>By default only articles containing all terms in the query are returned (i.e., AND is implied)</li>
        <li>Combine multiple words with OR to find articles containing either term (e.g., education OR research)</li>
        <li>Use parentheses to create more complex queries (e.g., archive (journal OR conference) NOT theses)</li>
        <li>Search for an exact phrase by putting it in quotes (e.g., "open access publishing")</li>
        <li>Exclude a word by prefixing it with - or NOT (e.g., online -politics or online NOT politics)</li>
        <li>Use * in a term as a wildcard to match any sequence of characters (e.g., soci* morality)</li>
    </ul>
</div>
@endsection
