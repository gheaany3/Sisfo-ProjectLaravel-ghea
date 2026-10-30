<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;

use Illuminate\Support\Facades\Route;

// Route Halaman Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// Route Resource untuk Master Data Kelas
Route::resource('kelas', KelasController::class)->parameters([
    'kelas' => 'kelas'
]);
Route::get('/kelas/{kelas}/nilai', [KelasController::class, 'nilai'])->name('kelas.nilai');
Route::get('/kelas/{kelas}/nilai/create', [KelasController::class, 'createNilai'])->name('kelas.nilai.create');
Route::post('/kelas/{kelas}/nilai', [KelasController::class, 'storeNilai'])->name('kelas.nilai.store');
Route::get('/kelas/{kelas}/nilai/{nilai}/edit', [KelasController::class, 'editNilai'])->name('kelas.nilai.edit');
Route::put('/kelas/{kelas}/nilai/{nilai}', [KelasController::class, 'updateNilai'])->name('kelas.nilai.update');
Route::delete('/kelas/{kelas}/nilai/{nilai}', [KelasController::class, 'destroyNilai'])->name('kelas.nilai.destroy');

// Route Resource untuk Master Data Siswa
Route::resource('siswas', SiswaController::class);
Route::get('/siswas/{siswa}/nilai', [SiswaController::class, 'nilai'])->name('siswas.nilai');
Route::get('/siswas/{siswa}/nilai/create', [SiswaController::class, 'createNilai'])->name('siswas.nilai.create');
Route::post('/siswas/{siswa}/nilai', [SiswaController::class, 'storeNilai'])->name('siswas.nilai.store');
Route::get('/siswas/{siswa}/nilai/{nilai}/edit', [SiswaController::class, 'editNilai'])->name('siswas.nilai.edit');
Route::put('/siswas/{siswa}/nilai/{nilai}', [SiswaController::class, 'updateNilai'])->name('siswas.nilai.update');
Route::delete('/siswas/{siswa}/nilai/{nilai}', [SiswaController::class, 'destroyNilai'])->name('siswas.nilai.destroy');
Route::get('/siswas/{siswa}/nilai/export', [SiswaController::class, 'exportNilai'])->name('siswas.nilai.export');

// Route Resource untuk Master Data Guru
Route::resource('gurus', GuruController::class);
Route::get('/gurus/{guru}/nilai', [GuruController::class, 'nilai'])->name('gurus.nilai');
Route::get('/gurus/{guru}/nilai/create', [GuruController::class, 'createNilai'])->name('gurus.nilai.create');
Route::post('/gurus/{guru}/nilai', [GuruController::class, 'storeNilai'])->name('gurus.nilai.store');
Route::get('/gurus/{guru}/nilai/{nilai}/edit', [GuruController::class, 'editNilai'])->name('gurus.nilai.edit');
Route::put('/gurus/{guru}/nilai/{nilai}', [GuruController::class, 'updateNilai'])->name('gurus.nilai.update');
Route::delete('/gurus/{guru}/nilai/{nilai}', [GuruController::class, 'destroyNilai'])->name('gurus.nilai.destroy');

// Route Resource untuk Master Data Mata Pelajaran (Mapel)
Route::resource('mapels', MapelController::class);
Route::get('/mapels/{mapel}/nilai', [MapelController::class, 'nilai'])->name('mapels.nilai');
Route::get('/mapels/{mapel}/nilai/create', [MapelController::class, 'createNilai'])->name('mapels.nilai.create');
Route::post('/mapels/{mapel}/nilai', [MapelController::class, 'storeNilai'])->name('mapels.nilai.store');
Route::get('/mapels/{mapel}/nilai/{nilai}/edit', [MapelController::class, 'editNilai'])->name('mapels.nilai.edit');
Route::put('/mapels/{mapel}/nilai/{nilai}', [MapelController::class, 'updateNilai'])->name('mapels.nilai.update');
Route::delete('/mapels/{mapel}/nilai/{nilai}', [MapelController::class, 'destroyNilai'])->name('mapels.nilai.destroy');

// Route Resource untuk Data Nilai Akademik
Route::resource('nilai', NilaiController::class);
Route::get('/nilai/export', [NilaiController::class, 'exportNilai'])->name('nilai.export');

use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Route untuk menampilkan halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Route untuk memproses form login
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

// Route untuk logout (biar tombol Keluar/Logout nanti berfungsi)
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');