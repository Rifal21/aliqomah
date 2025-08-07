<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('fo');
});
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/home', [HomeController::class, 'index'])->name('webpages.home');
Route::get('/kontak-kami', [HomeController::class, 'contact'])->name('webpages.contact');
Route::get('/alumni', [HomeController::class, 'alumni'])->name('webpages.alumni');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('webpages.about');
Route::get('/program/{name}', [HomeController::class, 'showProgram'])->name('webpages.showProgram');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('pages', PageController::class);
});

Route::prefix('pages/alumni')->group(function () {
    Route::get('/data', [AlumniController::class, 'index'])->name('alumni.index');
    Route::get('/datatable', [AlumniController::class, 'datatable'])->name('alumni.datatable');
    Route::post('/import', [AlumniController::class, 'import'])->name('alumni.import');
    Route::resource('alumni', AlumniController::class)->except(['index']);
});

Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');
