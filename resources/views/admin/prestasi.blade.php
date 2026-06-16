<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi - {{ $member->nama }}</title>
    <link rel="stylesheet" href="{{ asset('css/admin/prestasi.css') }}">
</head>
<body>
    <div class="container">
        
        <div class="header-card">
            <div class="header-info">
                <h2>🏆 Galeri Prestasi</h2>
                <p><strong>{{ $member->nama }}</strong> — {{ $member->sabuk }}</p>
            </div>
            <a href="/dashboard" class="btn-back">&larr; Kembali ke Dashboard</a>
        </div>

        @if(session('success')) <div class="alert-success">{{ session('success') }}</div> @endif
        @if($errors->any()) <div class="alert-success" style="background:#f8d7da; color:#721c24;">Gagal mengunggah! Pastikan file berupa gambar (jpg/png) maks 2MB.</div> @endif

        <div class="form-card">
            <h3 style="margin-top:0; color:#27ae60;">+ Tambah Medali / Sertifikat Baru</h3>
            <form action="/admin/anggota/{{ $member->id }}/prestasi" method="POST" enctype="multipart/form-data">
                @csrf
                <label style="font-weight:bold;">Nama Kejuaraan / Pencapaian</label>
                <input type="text" name="nama_prestasi" class="form-input" placeholder="Cth: Juara 1 Kumite O2SN 2024" required>
                
                <label style="font-weight:bold;">Unggah Foto Bukti (Maks 2MB)</label>
                <input type="file" name="foto_prestasi" class="form-input" accept="image/*">
                
                <button type="submit" class="btn-submit">Simpan Prestasi</button>
            </form>
        </div>

        @if($member->prestasi->count() > 0)
            <div class="gallery-grid">
                @foreach($member->prestasi as $pres)
                <div class="prestasi-card">
                    @if($pres->foto_prestasi)
                        <a href="{{ asset('storage/' . $pres->foto_prestasi) }}" target="_blank">
                            <img src="{{ asset('storage/' . $pres->foto_prestasi) }}" class="prestasi-img" alt="Foto Prestasi">
                        </a>
                    @else
                        <div class="prestasi-img" style="display:flex; align-items:center; justify-content:center; color:#aaa;">(Tidak ada foto)</div>
                    @endif
                    
                    <div class="prestasi-body">
                        <div class="prestasi-title">{{ $pres->nama_prestasi }}</div>
                        <form action="/admin/prestasi/{{ $pres->id }}/hapus" method="POST" onsubmit="return confirm('Hapus prestasi ini permanen?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete">Hapus Prestasi</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="no-data">
                <h2>📭</h2>
                <p>Belum ada data prestasi untuk anggota ini.</p>
            </div>
        @endif

    </div>
</body>
</html>