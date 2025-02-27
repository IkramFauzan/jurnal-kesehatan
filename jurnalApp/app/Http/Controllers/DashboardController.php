<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $steps = [
            ['name' => 'Upload File', 'route' => 'upload.file'],
            ['name' => 'Metadata Submission', 'route' => 'upload.metadata'],
            ['name' => 'Author Confirmation', 'route' => 'upload.author'],
            ['name' => 'Final Review', 'route' => 'upload.review'],
            ['name' => 'Publication', 'route' => 'upload.publish'],
        ];

        $currentStep = 3; // Contoh: User berada di tahap 3 (ubah sesuai dengan progress user)
        $progress = ($currentStep / count($steps)) * 100;

        return view('journals.dashboard', compact('steps', 'currentStep', 'progress'));
    }
}
