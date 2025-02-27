<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\DashboardController;

Route::get('/', [JournalController::class, 'index'])->name('journals.home');
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
});


Route::get('/test', function() {
    dd('Route works!');
});


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

