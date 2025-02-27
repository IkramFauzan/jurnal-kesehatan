@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

@section('content')
<div class="container mt-4">
    <h2>About the Journal</h2>
    <hr>
    
    <h4>People</h4>
    <ul>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Editorial Team</a></li>
    </ul>
    
    <h4>Policies</h4>
    <ul>
        <li><a href="#">Focus and Scope</a></li>
        <li><a href="#">Section Policies</a></li>
        <li><a href="#">Peer Review Process</a></li>
        <li><a href="#">Publication Frequency</a></li>
        <li><a href="#">Open Access Policy</a></li>
        <li><a href="#">Plagiarism Screening</a></li>
        <li><a href="#">Publication Ethics and Malpractice Statement</a></li>
    </ul>
    
    <h4>Submissions</h4>
    <ul>
        <li><a href="#">Online Submissions</a></li>
        <li><a href="#">Author Guidelines</a></li>
        <li><a href="#">Copyright Notice</a></li>
        <li><a href="#">Privacy Statement</a></li>
        <li><a href="#">Author Fees</a></li>
    </ul>
    
    <h4>Other</h4>
    <ul>
        <li><a href="#">Journal Sponsorship</a></li>
        <li><a href="#">Journal History</a></li>
        <li><a href="#">Site Map</a></li>
        <li><a href="#">About this Publishing System</a></li>
        <li><a href="#">Statistics</a></li>
    </ul>
</div>
@endsection
