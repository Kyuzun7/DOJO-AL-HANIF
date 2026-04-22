<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PressReleaseController;
Route::get('/', function () { 
    $latestArticles = \App\Models\PressRelease::orderBy('published_date', 'desc')->take(5)->get();
    return view('welcome', compact('latestArticles')); 
});

// Pendaftaran
Route::get('/daftar', [PendaftaranController::class, 'index']);
Route::post('/daftar', [PendaftaranController::class, 'store']);
Route::get('/pendaftaran-sukses', [PendaftaranController::class, 'sukses']);

// Profil Anggota (Publicly accessible)
Route::get('/profil-anggota', function () {
    $members = \App\Models\Member::orderBy('nama', 'asc')->get();

    $beltOrder = [
        'SABUK HITAM',
        'SABUK COKLAT',
        'SABUK UNGU',
        'SABUK BIRU',
        'SABUK HIJAU',
        'SABUK KUNING',
        'SABUK PUTIH',
        'BELUM PUNYA SABUK',
    ];

    $groupedMembers = [];
    foreach ($beltOrder as $belt) {
        $groupedMembers[$belt] = [];
    }

    foreach ($members as $member) {
        $sabukFull = $member->sabuk;
        if (str_contains($sabukFull, ' - ')) {
            $parts = explode(' - ', $sabukFull);
            $tingkatan = $parts[0];
            $warna = $parts[1];
            
            if (isset($groupedMembers[$warna])) {
                $member->tingkatan_sabuk = $tingkatan;
                $groupedMembers[$warna][] = $member;
            }
        } elseif ($sabukFull === 'Belum punya sabuk' || $sabukFull === null) {
            $member->tingkatan_sabuk = '-';
            if (isset($groupedMembers['BELUM PUNYA SABUK'])) {
                $groupedMembers['BELUM PUNYA SABUK'][] = $member;
            }
        }
    }

    // Filter out empty groups so we don't display empty sections
    foreach ($groupedMembers as $belt => $list) {
        if (count($list) === 0) {
            unset($groupedMembers[$belt]);
        }
    }

    return view('profil', compact('groupedMembers'));
});

// Artikel (Public)
Route::get('/artikel', [PressReleaseController::class, 'index']);
Route::get('/artikel/{slug}', [PressReleaseController::class, 'show']);

// Login/Logout
Route::post('/pintu-rahasia', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Dashboard Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'mainDashboard']);
    Route::get('/admin/anggota', [AuthController::class, 'dashboard']);
    
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
    Route::get('/admin/artikel', [PressReleaseController::class, 'adminIndex']);
    Route::get('/admin/artikel/create', [PressReleaseController::class, 'create']);
    Route::post('/admin/artikel', [PressReleaseController::class, 'store']);
    Route::get('/admin/artikel/{id}/edit', [PressReleaseController::class, 'edit']);
    Route::put('/admin/artikel/{id}', [PressReleaseController::class, 'update']);
    Route::delete('/admin/artikel/{id}', [PressReleaseController::class, 'destroy']);
});