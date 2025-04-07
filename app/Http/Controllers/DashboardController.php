<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Journal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {

        $sections = Section::all();
        $steps = [
            ['name' => 'Upload File', 'route' => 'upload.file'],
            ['name' => 'Metadata Submission', 'route' => 'upload.metadata'],
            ['name' => 'Author Confirmation', 'route' => 'upload.author'],
            ['name' => 'Final Review', 'route' => 'upload.review'],
            ['name' => 'Publication', 'route' => 'upload.publish'],
        ];

        $currentStep = 3; // Contoh: User berada di tahap 3 (ubah sesuai dengan progress user)
        $progress = ($currentStep / count($steps)) * 100;

        return view('journals.dashboard', compact('steps', 'currentStep', 'progress', 'sections'));
    }

    public function store(Request $request)
    {
        Log::info('Memulai proses upload jurnal.');

        $validatedData = $request->validate([
            'subtitle' => 'required|string|max:255',
            'volume' => 'required|integer',
            'authors' => 'required|string',
            'pages' => 'nullable|string|max:255',
            'abstract' => 'required|string',
            'keywords' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048', // Contoh validasi untuk file PDF atau DOC            'comment' => 'nullable|string',
            'comment' => 'nullable|string',
        ]);

        Log::info('Validasi berhasil.', ['data' => $validatedData]);

        $user = Auth::user();
        Log::info('User yang sedang login: ', ['user_id' => $user->id]);

        // if ($request->hasFile('file')) {
        //     $filePath = $request->file('file')->store('journals', 'public');
        //     Log::info('File berhasil diupload.', ['file_path' => $filePath]);
        // } else {
        //     Log::error('File tidak ditemukan saat upload.');
        //     return redirect()->back()->with('error', 'Gagal mengunggah file jurnal.');
        // }

        try {
            $fileName = 'journal_' . time() . '_' . Str::slug($request->subtitle) . '.pdf';
            $filePath = $request->file('file')->storeAs('journals', $fileName, 'public');
        } catch (\Exception $e) {
            Log::error('Gagal upload file: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengunggah file.');
        }

        $journal = Journal::create([
            'title' => 'Jurnal Kesehatan',
            'subtitle' => $request->subtitle,
            'volume' => $request->volume,
            'authors' => $request->authors,
            'pages' => $request->pages,
            'file_path' => $filePath,
            'doi_link' => NULL,
            'views' => 0,
            'downloads' => 0,
            'status' => 1,
            'upload_status' => $request->upload_status,
            'users_id' => $user->id,
            'alasan_penolakan' => NULL,
            'comment' => NULL,
            'keywords' => $request->keywords,
        ]);

        if ($journal) {
            Log::info('Jurnal berhasil disimpan di database.', ['journal_id' => $journal->id]);
            return redirect()->route('journals.dashboard')->with('success', 'Jurnal berhasil diunggah!');
        } else {
            Log::error('Gagal menyimpan jurnal ke database.');
            return redirect()->back()->with('error', 'Gagal menyimpan jurnal.');
        }
    }

    public function update(Request $request, $id)
    {
        Log::info('Memulai proses update jurnal.', ['journal_id' => $id]);

        $journal = Journal::findOrFail($id);
        Log::info('Jurnal ditemukan.', ['journal' => $journal]);

        $request->validate([
            'status' => 'required|integer',
            'alasan_penolakan' => 'nullable|string',
        ]);

        $journal->update([
            'status' => $request->status,
            'alasan_penolakan' => $request->alasan_penolakan,
        ]);

        Log::info('Jurnal berhasil diperbarui.', ['status' => $request->status, 'alasan_penolakan' => $request->alasan_penolakan]);

        return redirect()->back()->with('success', 'Status jurnal berhasil diperbarui!');
    }
}
