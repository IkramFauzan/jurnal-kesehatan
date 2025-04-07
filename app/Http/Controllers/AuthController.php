<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function showAdmin() {
        return view('admin.manage');
    }

    public function showReview() {
        return view('reviewer.review');
    }
    
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            if ($user->role == 'admin') {
                return redirect()->intended('/admin/manage')->with('success', 'Login berhasil!');
            } elseif ($user->role == 'reviewer') {
                return redirect()->intended('/review')->with('success', 'Login berhasil!');
            } else {
                return redirect()->intended('/dashboard')->with('success', 'Login berhasil!');
            }
        }
    
        return back()->with('error', 'Email atau password salah.');
    }    

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'given_name' => 'required|string|max:255',
            'family_name' => 'required|string|max:255',
            'afiliasi' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'terms' => 'accepted', // Untuk checkbox persetujuan
        ]);
    
        $user = User::create([
            'given_name' => $request->given_name,
            'family_name' => $request->family_name,
            'afiliasi' => $request->afiliasi,
            'country' => $request->country,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'role' => 'user', // Set role default menjadi user
        ]);

        $user->assignRole('user'); // Assign default role
    
        Auth::login($user);
    
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
    
    
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
