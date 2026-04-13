<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member; // Memanggil model Member

class PendaftaranController extends Controller
{
    // Fungsi untuk menampilkan halaman form pendaftaran
    public function index()
    {
        return view('pendaftaran.daftar'); // Ini akan memanggil file daftar.blade.php
    }

    // Fungsi untuk menangkap data, simpan ke database, dan lempar ke WA
    public function store(Request $request)
    {
        // 1. Validasi: Memastikan data yang dikirim tidak ngawur
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_whatsapp' => 'required|string|max:20',
            'umur' => 'nullable|integer',
            'sabuk' => 'nullable|string',
        ]);

        // 2. Simpan data ke database tabel 'members'
        // (Status akan otomatis jadi 'calon' karena sudah kita atur di Migration)
        Member::create($validatedData);

        // 3. Siapkan nomor tujuan dan format teks WhatsApp
        // Ganti nomor di bawah ini dengan nomor WA kamu (Admin)
        // Gunakan format 62 tanpa tanda + atau angka 0 di depan
        $nomorAdmin = '6283895930746';

        $pesan = "Osu! Halo Admin DOJO AL-HANIF,\n\n";
        $pesan .= "Ada pendaftar calon anggota baru nih:\n";
        $pesan .= "🥋 Nama: " . $request->nama_lengkap . "\n";
        $pesan .= "📱 No WA: " . $request->no_whatsapp . "\n";
        $pesan .= "🎂 Umur: " . ($request->umur ?? 'Tidak diisi') . "\n";
        $pesan .= "🎗️ Sabuk: " . ($request->sabuk ?? 'Belum ada (Pemula)') . "\n\n";
        $pesan .= "Tolong segera dikonfirmasi ya, Terima kasih!";

        // urlencode berfungsi mengubah spasi atau enter menjadi format link internet yang sah
        $linkWhatsApp = "https://wa.me/{$nomorAdmin}?text=" . urlencode($pesan);

        // 4. Lemparkan pendaftar ke aplikasi/web WhatsApp!
        return redirect()->away($linkWhatsApp);
    }
}