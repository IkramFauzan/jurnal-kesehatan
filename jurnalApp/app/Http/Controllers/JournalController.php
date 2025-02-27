<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::latest()->paginate(10);
        return view('journals.home', compact('journals'));
    }

    public function show($id)
    {
        $journals =Journal::findOrFail($id);
        return view('journals.show', compact('journals'));
    }
 
    public function create()
    {
        return view('journals.create');
    }

    public function about()
    {
        return view('journals.about');
    }

    public function search()
    {
        return view('journals.search');
    }

    public function contact()
    {
        return view('journals.contact');
    }

    public function announcements()
    {
        return view('journals.announcements');
    }

    public function archives()
    {
        return view('journals.archives');
    }

    public function current()
    {
        return view('journals.current');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'abstract' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $filePath = $request->file('file')->store('journals', 'public');

        Journal::create([
            'title' => $request->title,
            'author' => $request->author,
            'abstract' => $request->abstract,
            'file_path' => $filePath,
        ]);

        return redirect()->route('journals.home')->with('success', 'Jurnal berhasil ditambahkan!'); // ✅
    }
}
