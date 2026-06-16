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
            'nomor_anggota' => \App\Models\Member::generateNomorAnggota(),
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

        $data = [
            'nama' => $request->nama,
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
        ];

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($member->foto) {
                Storage::disk('public')->delete($member->foto);
            }
            $data['foto'] = $request->file('foto')->store('member_foto', 'public');
        }

        $member->update($data);

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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('member_foto', 'public');
        }

        // 2. Set default status dan tanggal
        $data['status'] = 'aktif';
        $data['tanggal_diterima'] = now();
        $data['nomor_anggota'] = \App\Models\Member::generateNomorAnggota();

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

    public function exportMembers(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $namaBulan = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];

        $bulanNama = $namaBulan[str_pad($bulan, 2, '0', STR_PAD_LEFT)] ?? 'Semua';

        $members = Member::whereMonth('tanggal_diterima', $bulan)
                         ->whereYear('tanggal_diterima', $tahun)
                         ->orderBy('tanggal_diterima', 'asc')
                         ->get();

        $filename = "laporan_pendaftaran_anggota_{$bulan}_{$tahun}.csv";

        $callback = function() use ($members, $bulanNama, $tahun) {
            $handle = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Microsoft Excel compliance
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            // Write report headers
            fputcsv($handle, ['LAPORAN PENDAFTARAN ANGGOTA DOJO AL-HANIF']);
            fputcsv($handle, ["Periode: {$bulanNama} {$tahun}"]);
            fputcsv($handle, ["Total Pendaftar Baru: " . $members->count() . " Anggota"]);
            fputcsv($handle, []); // Empty row

            // Write table headers
            fputcsv($handle, [
                'No', 
                'No. Anggota', 
                'Nama Anggota', 
                'Tempat Lahir', 
                'Tanggal Lahir', 
                'Umur (Tahun)', 
                'Sabuk', 
                'Berat Badan (kg)', 
                'Tinggi Badan (cm)', 
                'Ukuran Baju', 
                'Nama Ayah', 
                'No. HP Ayah', 
                'Nama Ibu', 
                'No. HP Ibu', 
                'Alamat', 
                'Tanggal Diterima', 
                'Status'
            ]);

            $no = 1;
            foreach ($members as $member) {
                fputcsv($handle, [
                    $no++,
                    $member->nomor_anggota ?? '-',
                    $member->nama,
                    $member->tempat_lahir,
                    $member->tanggal_lahir ? $member->tanggal_lahir->format('d-m-Y') : '-',
                    $member->tanggal_lahir ? $member->tanggal_lahir->age : '-',
                    $member->sabuk,
                    $member->berat_badan,
                    $member->tinggi_badan,
                    $member->ukuran_baju,
                    $member->nama_ayah,
                    $member->no_hp_ayah,
                    $member->nama_ibu,
                    $member->no_hp_ibu,
                    $member->alamat,
                    $member->tanggal_diterima ? $member->tanggal_diterima->format('d-m-Y') : '-',
                    strtoupper($member->status),
                ]);
            }

            fclose($handle);
        };

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->stream($callback, 200, $headers);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }



}