<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewerController extends Controller
{

    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 4;

    public function index()
    {
        $journals = Journal::where('status', 1)->latest()->paginate(10);
        return view('reviewer.review', compact('journals'));
    }

    public function showReview()
    {
        $journals = Journal::where('status', 1)->latest()->paginate(10);
        return view('reviewer.review', compact('journals'));
    }

    public function approve($id)
    {
        try {
            $journal = Journal::findOrFail($id);
            $journal->update([
                'status' => self::STATUS_APPROVED
            ]);

            return redirect('/review')->with('success', 'Jurnal berhasil disetujui.');
        } catch (\Exception $e) {
            return redirect('/review')->with('error', 'Terjadi kesalahan saat menyetujui jurnal.');
        }
    }

    // public function reject(Request $request, $id)
    // {
    //     $request->validate([
    //         'reason' => 'required|string|max:255'
    //     ]);

    //     try {
    //         $journal = Journal::findOrFail($id);
    //         $journal->update([
    //             'status' => 4,
    //             'alasan_penolakan' => $request->input('reason')
    //         ]);

    //         // Log informasi
    //         Log::info('Journal rejected:', [
    //             'id' => $journal->id,
    //             'status' => 4,
    //             'alasan_penolakan' => $request->input('reason')
    //         ]);

    //         return redirect('/review')->with('success', 'Jurnal berhasil ditolak.');
    //     } catch (\Exception $e) {
    //         // Log error
    //         Log::error('Error rejecting journal:', [
    //             'error' => $e->getMessage()
    //         ]);

    //         return redirect('/review')->with('error', 'Terjadi kesalahan saat menolak jurnal.');
    //     }
    // }

    public function reject(Request $request, $id)
    {
        try {
            $journal = Journal::findOrFail($id);

            // 1. Ambil alasan dari checkbox (jika ada)
            $checkboxReasons = [];
            if ($request->has('rejection_reasons')) {
                $checkboxReasons = json_decode($request->input('rejection_reasons'), true);
            }

            // 2. Ambil alasan custom (textarea)
            $customReason = $request->input('custom_reason');

            // Update database
            $journal->update([
                'status' => 4, // Status "Ditolak"
                'alasan_penolakan' => $customReason, // Hanya simpan custom reason di sini
                'rejection_reasons' => !empty($checkboxReasons) ? json_encode($checkboxReasons) : null // Simpan checkbox reasons sebagai JSON
            ]);

            // Log informasi
            Log::info('Journal rejected:', [
                'id' => $journal->id,
                'status' => 4,
                'alasan_penolakan' => $customReason,
                'rejection_reasons' => $checkboxReasons
            ]);

            return redirect('/review')->with('success', 'Jurnal berhasil ditolak.');
        } catch (\Exception $e) {
            Log::error('Error rejecting journal:', [
                'error' => $e->getMessage()
            ]);
            return redirect('/review')->with('error', 'Terjadi kesalahan saat menolak jurnal.');
        }
    }
}
