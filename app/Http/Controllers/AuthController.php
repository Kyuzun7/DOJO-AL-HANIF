<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonMember;
use App\Models\Member;
use App\Models\PrestasiMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate(['username' => 'required', 'password' => 'required']);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Berhasil masuk! Silakan akses tombol Dashboard.');
        }
        return back()->with('error', 'Akses ditolak!');
    }

    public function mainDashboard()
    {
        return view('admin.main_dashboard');
    }

    public function dashboard()
    {
        $calon = CalonMember::orderBy('created_at', 'desc')->get();
        $aktif = Member::with('prestasi')->where('status', 'aktif')->orderBy('created_at', 'desc')->get();
        $tidak_aktif = Member::with('prestasi')->where('status', 'tidak_aktif')->orderBy('tanggal_dinonaktifkan', 'desc')->get();

        return view('admin.dashboard', compact('calon', 'aktif', 'tidak_aktif'));
    }

    public function terimaMember($id)
    {
        $calon = CalonMember::findOrFail($id);

        Member::create([
            'nama' => $calon->nama,
            'tempat_lahir' => $calon->tempat_lahir,
            'tanggal_lahir' => $calon->tanggal_lahir,
            'berat_badan' => $calon->berat_badan,
            'tinggi_badan' => $calon->tinggi_badan,
            'nama_ayah' => $calon->nama_ayah,
            'no_hp_ayah' => $calon->no_hp_ayah,
            'nama_ibu' => $calon->nama_ibu,
            'no_hp_ibu' => $calon->no_hp_ibu,
            'alamat' => $calon->alamat,
            'ukuran_baju' => $calon->ukuran_baju,
            'sabuk' => 'Belum punya sabuk',
            'status' => 'aktif',
            'tanggal_diterima' => now(),
        ]);

        $calon->delete();
        return back()->with('success', 'Anggota berhasil diterima!');
    }

    public function hapusCalon($id)
    {
        CalonMember::findOrFail($id)->delete();
        return back()->with('success', 'Pendaftar ditolak & dihapus.');
    }

    public function updateAnggota(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $statusLama = $member->status;
        $statusBaru = $request->status;

        $member->update([
            'nama' => $request->nama,
            // TAMBAHAN: Menyimpan perubahan Tempat & Tanggal Lahir
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,

            'sabuk' => $request->sabuk,
            'alamat' => $request->alamat,
            'ukuran_baju' => $request->ukuran_baju,
            'status' => $statusBaru,
            'nama_ayah' => $request->nama_ayah,
            'no_hp_ayah' => $request->no_hp_ayah,
            'nama_ibu' => $request->nama_ibu,
            'no_hp_ibu' => $request->no_hp_ibu,
        ]);

        if ($statusLama == 'aktif' && $statusBaru == 'tidak_aktif') {
            $member->update(['tanggal_dinonaktifkan' => now()]);
        } elseif ($statusLama == 'tidak_aktif' && $statusBaru == 'aktif') {
            $member->update(['tanggal_dinonaktifkan' => null]);
        }

        return back()->with('success', 'Data anggota berhasil diperbarui!');
    }

    // FUNGSI BARU: Tambah Anggota Langsung (Bypass Calon)
    public function storeAnggotaAktif(Request $request)
    {
        // 1. Validasi Data
        $data = $request->validate([
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'nama_ayah' => 'required',
            'no_hp_ayah' => 'required',
            'nama_ibu' => 'required',
            'no_hp_ibu' => 'required',
            'alamat' => 'required',
            'ukuran_baju' => 'required',
            'sabuk' => 'required',
        ]);

        // 2. Set default status dan tanggal
        $data['status'] = 'aktif';
        $data['tanggal_diterima'] = now();

        // 3. Simpan ke database members
        $member = Member::create($data);

        // 4. Jika ada input prestasi saat mendaftar, langsung simpan
        if ($request->filled('nama_prestasi')) {
            $path = null;
            if ($request->hasFile('foto_prestasi')) {
                $request->validate(['foto_prestasi' => 'image|mimes:jpeg,png,jpg|max:2048']);
                $path = $request->file('foto_prestasi')->store('prestasi_foto', 'public');
            }

            PrestasiMember::create([
                'member_id' => $member->id,
                'nama_prestasi' => $request->nama_prestasi,
                'foto_prestasi' => $path,
            ]);
        }

        return back()->with('success', 'Anggota Baru berhasil ditambahkan langsung ke data Aktif!');
    }

    // FUNGSI BARU: Menampilkan Halaman Khusus Prestasi
    public function showPrestasi($id)
    {
        $member = Member::with('prestasi')->findOrFail($id);
        return view('admin.prestasi', compact('member'));
    }

    public function tambahPrestasi(Request $request, $id)
    {
        $request->validate([
            'nama_prestasi' => 'required',
            'foto_prestasi' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('foto_prestasi')) {
            $path = $request->file('foto_prestasi')->store('prestasi_foto', 'public');
        }

        PrestasiMember::create([
            'member_id' => $id,
            'nama_prestasi' => $request->nama_prestasi,
            'foto_prestasi' => $path,
        ]);

        return back()->with('success', 'Prestasi & Foto berhasil ditambahkan!');
    }

    public function hapusPrestasi($id)
    {
        $prestasi = PrestasiMember::findOrFail($id);

        if ($prestasi->foto_prestasi) {
            Storage::disk('public')->delete($prestasi->foto_prestasi);
        }

        $prestasi->delete();
        return back()->with('success', 'Prestasi dihapus!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }



}