<?php

namespace App\Http\Controllers;
use App\Models\Archive;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index() {
        $archives = Archive::orderBy('year', 'desc')->orderBy('volume', 'desc')->get();
        return view('journals.archives', compact('archives'));
    }
}