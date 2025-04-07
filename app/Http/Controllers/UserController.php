<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Mengambil user yang sedang login
        $status = DB::table('status')->get()->groupBy('id');
        if ($user) { // Pastikan user terautentikasi
            $journals = Journal::where('users_id', $user->id)->latest()->paginate(10);
            return view('user.index', compact('journals', 'status'));
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    }

}
