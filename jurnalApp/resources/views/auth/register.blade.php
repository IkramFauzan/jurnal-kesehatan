@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="register-container">
        <h2>Register</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('auth.register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="given_name">Given Name</label>
                <input id="given_name" type="text" name="given_name" class="form-control" required>
                @error('given_name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="family_name">Family Name</label>
                <input id="family_name" type="text" name="family_name" class="form-control" required>
                @error('family_name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="afiliasi">Afiliasi</label>
                <input id="afiliasi" type="text" name="afiliasi" class="form-control">
                @error('afiliasi') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="country">Country</label>
                <input id="country" type="text" name="country" class="form-control" required>
                @error('country') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" class="form-control" required>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" class="form-control" required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="terms" id="terms" class="form-check-input" required>
                <label class="form-check-label" for="terms">Saya setuju dengan syarat dan ketentuan</label>
                @error('terms') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">Register</button>
        </form>
    </div>
</div>
@endsection
