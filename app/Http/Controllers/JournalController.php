<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class JournalController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        $journals = Journal::latest()->paginate(10);
        return view('journals.home', compact('journals', 'sections'));
    }

    public function show($id)
    {
        $journals = Journal::findOrFail($id);
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
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'volume' => 'nullable|string|max:255',
            'authors' => 'required|string',
            'pages' => 'nullable|string|max:255',
            'doi_link' => 'nullable|string|max:255',
            'abstract' => 'required|string',
            'keywords' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048', // Contoh validasi untuk file PDF atau DOC            'comment' => 'nullable|string',
            'alasan_penolakan' => 'nullable|string',
        ]);

        $user = Auth::user(); // Mengambil user yang sedang login

        // Simpan file jurnal
        $filePath = $request->file('file')->store('journals', 'public');

        // Simpan data ke database
        Journal::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'volume' => $request->volume,
            'authors' => $request->authors,
            'pages' => $request->pages,
            'file_path' => $filePath,
            'doi_link' => $request->doi_link,
            'views' => 0, // Default 0
            'downloads' => 0, // Default 0
            'status' => 1, // Default status 1 (Belum di-review)
            'upload_status' => $request->upload_status,
            'users_id' => $user->id,
            'alasan_penolakan' => $request->alasan_penolakan,
            'comment' => $request->comment,
            'keywords' => $request->keywords,
        ]);

        return redirect()->back()->with('success', 'Jurnal berhasil diunggah!');
    }

    public function update(Request $request, $id)
    {
        $journal = Journal::findOrFail($id);
        $request->validate([
            'status' => 'required|integer',
            'alasan_penolakan' => 'nullable|string',
        ]);

        $journal->update([
            'status' => $request->status,
            'alasan_penolakan' => $request->alasan_penolakan,
        ]);

        return redirect()->back()->with('success', 'Status jurnal berhasil diperbarui!');
    }

    // Menampilkan PDF dan menambah jumlah views
    public function viewPdf($id)
    {
        try {
            $article = Journal::findOrFail($id);
            $filePath = storage_path('app/public/' . $article->file_path);

            if (!file_exists($filePath)) {
                abort(404, "File not found");
            }

            $fileName = Str::slug($article->title) . '.pdf';

            // Debugging: Cetak ID artikel dan jumlah views sebelum di-increment
            Log::info("Viewing PDF for article ID: $id, Current views: " . $article->views);

            $article->increment('views');

            // Debugging: Cetak jumlah views setelah di-increment
            Log::info("Views after increment: " . $article->views);

            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Cache-Control' => 'no-cache, no-store, must-revalidate', // Nonaktifkan caching
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat PDF: ' . $e->getMessage());
        }
    }

    public function downloadPdf($id)
    {
        try {
            $article = Journal::findOrFail($id);
            $filePath = storage_path('app/public/' . $article->file_path);

            if (!file_exists($filePath)) {
                abort(404, "File not found");
            }

            // Debugging: Cetak ID artikel dan jumlah downloads sebelum di-increment
            Log::info("Downloading PDF for article ID: $id, Current downloads: " . $article->downloads);

            $article->increment('downloads');

            // Debugging: Cetak jumlah downloads setelah di-increment
            Log::info("Downloads after increment: " . $article->downloads);

            return response()->download($filePath, Str::slug($article->title) . '.pdf', [
                'Cache-Control' => 'no-cache, no-store, must-revalidate', // Nonaktifkan caching
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengunduh PDF: ' . $e->getMessage());
        }
    }
}
