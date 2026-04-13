<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route untuk menampilkan halaman form (GET)
Route::get('/daftar', [PendaftaranController::class, 'index']);

// Route untuk memproses data saat tombol submit ditekan (POST)
// throttle:3,1 artinya maksimal 3 kali percobaan dalam 1 menit
Route::post('/daftar', [PendaftaranController::class, 'store'])->middleware('throttle:3,5');

// Pintu Masuk Rahasia (POST)
Route::post('/pintu-rahasia', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Halaman Dashboard (Hanya bisa masuk kalau sudah login)
Route::get('/dashboard', function() {
    return "<h1>Selamat Datang Boss! Anda Login sebagai " . Auth::user()->name . "</h1>";
})->middleware('auth');