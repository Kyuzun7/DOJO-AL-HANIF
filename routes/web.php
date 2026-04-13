<?php

use Illuminate\Support\Facades\Route;
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