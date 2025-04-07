<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Journal;
use App\Models\Section;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function section()
    {
        $sections = Section::all();
        return view('admin.section', compact('sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'section_name' => 'required'
        ]);

        Section::insert(['section' => $request->section_name]);
        return redirect()->route('admin.section');
    }

    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();

        return redirect()->route('admin.section')->with('success', 'Section deleted successfully');
    }

    public function showUserManagement()
    {
        $users = User::all();
        return view('admin.manage', compact('users'));
    }

    public function promoteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->role = 'reviewer';
            $user->save();

            return response()->json(['success' => true, 'message' => 'User promoted to reviewer successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'User not found.'], 404);
    }

    public function addReviewer(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);
        $user->assignRole('reviewer');

        return back()->with('success', 'User berhasil dijadikan reviewer.');
    }

    public function showPublish()
    {
        $journals = Journal::where('status', 2)->latest()->paginate(10);
        return view('admin.publish', compact('journals'));
    }
}
