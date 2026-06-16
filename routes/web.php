<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\MemberProfileController;
use App\Http\Controllers\JadwalController;

Route::get('/', function () { 
    $latestArticles = \App\Models\Artikel::orderBy('published_date', 'desc')->take(5)->get();
    $kegiatans = \App\Models\Kegiatan::where('event_date', '>=', now()->toDateString())->orderBy('event_date', 'asc')->get();
    $jadwals = \App\Models\Jadwal::all();
    return view('welcome', compact('latestArticles', 'kegiatans', 'jadwals')); 
});

// Pendaftaran
Route::get('/daftar', [PendaftaranController::class, 'index']);
Route::post('/daftar', [PendaftaranController::class, 'store']);
Route::get('/pendaftaran-sukses', [PendaftaranController::class, 'sukses']);

// Profil Anggota (Publicly accessible)
Route::get('/profil-anggota', [MemberProfileController::class, 'index']);
Route::get('/profil-anggota/{id}', [MemberProfileController::class, 'show']);

// Artikel (Public)
Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/artikel/{slug}', [ArtikelController::class, 'show']);

// Kegiatan (Public)
Route::get('/kegiatan/{slug}', [KegiatanController::class, 'show']);

// Struktur Organisasi (Public)
Route::get('/struktur-organisasi', [PengurusController::class, 'index']);

// Login/Logout
Route::post('/pintu-rahasia', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Dashboard Admin
Route::middleware(['auth', 'restrict.tier2'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'mainDashboard']);
    
    // Profil Admin
    Route::get('/admin/profile', [\App\Http\Controllers\AdminProfileController::class, 'index']);
    Route::get('/admin/profile/create', [\App\Http\Controllers\AdminProfileController::class, 'create']);
    Route::post('/admin/profile', [\App\Http\Controllers\AdminProfileController::class, 'store']);
    Route::get('/admin/profile/{id}/edit', [\App\Http\Controllers\AdminProfileController::class, 'edit']);
    Route::put('/admin/profile/{id}', [\App\Http\Controllers\AdminProfileController::class, 'update']);
    Route::delete('/admin/profile/{id}', [\App\Http\Controllers\AdminProfileController::class, 'destroy']);
    Route::get('/admin/anggota', [AuthController::class, 'dashboard']);
    Route::get('/admin/anggota/export', [AuthController::class, 'exportMembers']);
    
    // Calon
    Route::post('/admin/calon/{id}/terima', [AuthController::class, 'terimaMember']);
    Route::delete('/admin/calon/{id}/hapus', [AuthController::class, 'hapusCalon']);

    // Anggota (Update Dasar & Status)
    Route::put('/admin/anggota/{id}', [AuthController::class, 'updateAnggota']);
    Route::post('/admin/anggota', [AuthController::class, 'storeAnggotaAktif']);
    
    // FITUR PRESTASI KHUSUS (Halaman Baru)
    Route::get('/admin/anggota/{id}/prestasi', [AuthController::class, 'showPrestasi']); // <-- Rute Baru
    Route::post('/admin/anggota/{id}/prestasi', [AuthController::class, 'tambahPrestasi']);
    Route::delete('/admin/prestasi/{id}/hapus', [AuthController::class, 'hapusPrestasi']);

    // Admin Artikel
    Route::get('/admin/artikel', [ArtikelController::class, 'adminIndex']);
    Route::get('/admin/artikel/create', [ArtikelController::class, 'create']);
    Route::post('/admin/artikel', [ArtikelController::class, 'store']);
    Route::get('/admin/artikel/{id}/edit', [ArtikelController::class, 'edit']);
    Route::put('/admin/artikel/{id}', [ArtikelController::class, 'update']);
    Route::delete('/admin/artikel/{id}', [ArtikelController::class, 'destroy']);

    // Admin Kegiatan
    Route::get('/admin/kegiatan', [KegiatanController::class, 'adminIndex']);
    Route::get('/admin/kegiatan/create', [KegiatanController::class, 'create']);
    Route::post('/admin/kegiatan', [KegiatanController::class, 'store']);
    Route::get('/admin/kegiatan/{id}/edit', [KegiatanController::class, 'edit']);
    Route::put('/admin/kegiatan/{id}', [KegiatanController::class, 'update']);
    Route::delete('/admin/kegiatan/{id}', [KegiatanController::class, 'destroy']);

    // Admin Pengurus
    Route::get('/admin/pengurus', [PengurusController::class, 'adminIndex']);
    Route::get('/admin/pengurus/create', [PengurusController::class, 'create']);
    Route::post('/admin/pengurus', [PengurusController::class, 'store']);
    Route::get('/admin/pengurus/{id}/edit', [PengurusController::class, 'edit']);
    Route::put('/admin/pengurus/{id}', [PengurusController::class, 'update']);
    Route::delete('/admin/pengurus/{id}', [PengurusController::class, 'destroy']);

    // Admin Jadwal
    Route::get('/admin/jadwal', [JadwalController::class, 'adminIndex']);
    Route::get('/admin/jadwal/create', [JadwalController::class, 'create']);
    Route::post('/admin/jadwal', [JadwalController::class, 'store']);
    Route::get('/admin/jadwal/{id}/edit', [JadwalController::class, 'edit']);
    Route::put('/admin/jadwal/{id}', [JadwalController::class, 'update']);
    Route::delete('/admin/jadwal/{id}', [JadwalController::class, 'destroy']);

    // Admin Absensi
    Route::get('/admin/absensi/rekap', [\App\Http\Controllers\AbsensiController::class, 'rekap']);
    Route::get('/admin/absensi/export', [\App\Http\Controllers\AbsensiController::class, 'export']);
    Route::get('/admin/absensi', [\App\Http\Controllers\AbsensiController::class, 'index']);
    Route::post('/admin/absensi', [\App\Http\Controllers\AbsensiController::class, 'store']);
});