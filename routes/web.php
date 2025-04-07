<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\UserController;

Route::get('/', [JournalController::class, 'index'])->name('journals.home');

Route::get('/article/view/{id}', [JournalController::class, 'viewPdf'])->name('article.view');
Route::get('/article/download-pdf/{id}', [JournalController::class, 'downloadPdf'])->name('article.download-pdf');

Route::get('/journals/{id}', [JournalController::class, 'show'])->name('journals.show');
Route::get('/admin/journals/create', [JournalController::class, 'create'])->name('journals.create');
Route::post('/admin/journals', [JournalController::class, 'store'])->name('journals.store');
Route::get('/about', [JournalController::class, 'about'])->name('journals.about');
Route::get('/search', [JournalController::class, 'search'])->name('journals.search');
Route::get('/contact', [JournalController::class, 'contact'])->name('journals.contact');
Route::get('/current', [JournalController::class, 'current'])->name('journals.current');
Route::get('/archives', [ArchiveController::class, 'index'])->name('journals.archives');
Route::get('/announcements', [JournalController::class, 'announcements'])->name('journals.announcements');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('journals.dashboard');
    Route::post('/journals', [DashboardController::class, 'store'])->name('journals.store');

    Route::get('/status', [UserController::class, 'index'])->name('user.index');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/admin/manage', [AdminController::class, 'showUserManagement'])->name('admin.manage');
        Route::get('/admin/publish', [AdminController::class, 'showPublish'])->name('admin.publish');
        Route::get('/sections', [AdminController::class, 'section'])->name('admin.section'); // Menampilkan halaman section
        Route::post('/sections', [AdminController::class, 'store'])->name('sections.store'); // Menyimpan data section
        Route::delete('/sections/{id}', [AdminController::class, 'destroy'])->name('sections.destroy');    
        Route::post('/admin/promote-user/{id}', [AdminController::class, 'promoteUser'])->name('admin.promote.user');
    });

    Route::group(['middleware' => ['role:reviewer']], function () {
        Route::get('/review', [ReviewerController::class, 'showReview'])->name('reviewer.review');
    });

    Route::put('/journals/{id}/approve', [ReviewerController::class, 'approve'])->name('journals.review');
    Route::put('/journals/{id}/reject', [ReviewerController::class, 'reject'])->name('journals.review ');
});


Route::get('/test', function () {
    dd('Route works!');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register']);
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
