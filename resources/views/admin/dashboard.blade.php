<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - DOJO AL-HANIF</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>

<body>
    <div class="container">
        <h2>Dashboard Anggota</h2>
        <a href="/dashboard" class="link-back">&larr; Kembali ke Dashboard Utama</a>

        @if(session('success'))
            <div class="alert-success" style="font-weight: bold; margin-bottom: 20px;">✓ {{ session('success') }}</div>
        @endif

        <div class="top-controls">
            <div class="menu-bar">
                <button class="tab-btn active" onclick="openTab(event, 'Calon')">1. Calon Anggota
                    ({{ $calon->count() }})</button>
                <button class="tab-btn" onclick="openTab(event, 'Aktif')">2. Anggota Aktif
                    ({{ $aktif->count() }})</button>
                <button class="tab-btn" onclick="openTab(event, 'TidakAktif')">3. Anggota Tidak Aktif
                    ({{ $tidak_aktif->count() }})</button>
            </div>

            <div>
                <input type="text" id="searchInput" class="search-box" onkeyup="searchMember()"
                    placeholder="🔍 Cari nama, sabuk, atau no HP...">
            </div>
        </div>

        <hr style="margin-bottom: 20px; border: 1px solid #eee;">

        <div id="Calon" class="tab-content active">
            <h3 style="color: #d35400;">🟠 Daftar Calon (Belum Diverifikasi)</h3>
            <div style="overflow-x: auto;">
                <table>
                    <tr>
                        <th>Nama</th>
                        <th>Tempat, Tgl Lahir</th>
                        <th>Umur / BB / TB / Baju</th>
                        <th>Orang Tua (No HP)</th>
                        <th>Aksi</th>
                    </tr>
                    @forelse($calon as $c)
                        <tr class="data-row">
                            <td><strong>{{ $c->nama }}</strong></td>
                            <td style="color: #444; font-size: 13px;">
                                {{ $c->tempat_lahir }},<br>{{ \Carbon\Carbon::parse($c->tanggal_lahir)->format('d M Y') }}
                            </td>
                            <td style="color: #444;">{{ \Carbon\Carbon::parse($c->tanggal_lahir)->age }} Thn |
                                {{ $c->berat_badan }}kg | {{ $c->tinggi_badan }}cm | {{ $c->ukuran_baju }}
                            </td>
                            <td style="font-size: 13px; line-height: 1.5;">
                                Ayah: {{ $c->nama_ayah }} (<a href="https://wa.me/{{ $c->no_hp_ayah }}" target="_blank"
                                    style="color:#25d366; text-decoration:none; font-weight:bold;">WA</a>)<br>
                                Ibu: {{ $c->nama_ibu }} (<a href="https://wa.me/{{ $c->no_hp_ibu }}" target="_blank"
                                    style="color:#25d366; text-decoration:none; font-weight:bold;">WA</a>)
                            </td>
                            <td>
                                <form action="/admin/calon/{{ $c->id }}/terima" method="POST" class="action-form">
                                    @csrf <button class="btn bg-green">Terima</button>
                                </form>
                                <form action="/admin/calon/{{ $c->id }}/hapus" method="POST" class="action-form"
                                    onsubmit="return confirm('Tolak pendaftar ini?')">
                                    @csrf @method('DELETE') <button class="btn bg-red"
                                        style="margin-top: 5px;">Tolak</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 30px; color: #7f8c8d;">Tidak ada pendaftar
                                baru saat ini.</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>

        <div id="Aktif" class="tab-content">
            <div
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
                <h3 style="color: #27ae60; margin: 0;">🟢 Daftar Anggota Aktif</h3>
                <button class="btn bg-green" onclick="openModal('modalTambahLangsung')"
                    style="padding: 10px 15px; font-size: 14px; box-shadow: 0 4px 6px rgba(39, 174, 96, 0.3);">
                    + Tambah Anggota
                </button>
            </div>

            <div style="overflow-x: auto;">
                <table>
                    <tr>
                        <th>Nama & Sabuk</th>
                        <th>Tempat, Tgl Lahir</th>
                        <th>Umur / BB / TB / Baju</th>
                        <th>Orang Tua (No HP)</th>
                        <th>Tgl Diterima</th>
                        <th>Prestasi</th>
                        <th>Aksi</th>
                    </tr>
                    @forelse($aktif as $a)
                        <tr class="data-row">
                            <td>
                                <strong style="font-size: 15px; color: #2c3e50;">{{ $a->nama }}</strong><br>
                                <span
                                    style="font-size: 12px; font-weight: bold; color: #fff; background: #ff0000ff; padding: 2px 6px; border-radius: 4px; display: inline-block; margin-top: 5px;">
                                    {{ $a->sabuk }}
                                </span>
                            </td>
                            <td style="color: #444; font-size: 13px;">
                                {{ $a->tempat_lahir }},<br>{{ \Carbon\Carbon::parse($a->tanggal_lahir)->format('d M Y') }}
                            </td>
                            <td style="color: #444;">{{ \Carbon\Carbon::parse($a->tanggal_lahir)->age }} Thn |
                                {{ $a->berat_badan }}kg | {{ $a->tinggi_badan }}cm | {{ $a->ukuran_baju }}
                            </td>

                            <td style="font-size: 13px; line-height: 1.5; color: #444;">
                                Ayah: {{ $a->nama_ayah }} (<a href="https://wa.me/{{ $a->no_hp_ayah }}" target="_blank" style="color:#25d366; text-decoration:none; font-weight:bold;">WA</a>)<br>
                                Ibu: {{ $a->nama_ibu }} (<a href="https://wa.me/{{ $a->no_hp_ibu }}" target="_blank" style="color:#25d366; text-decoration:none; font-weight:bold;">WA</a>)
                            </td>

                            <td style="font-size: 13px; color: #444;">{{ $a->tanggal_diterima->format('d M Y') }}</td>
                            <td>
                                <a href="/admin/anggota/{{ $a->id }}/prestasi" class="btn-prestasi">
                                    🏆 {{ $a->prestasi->count() }} Medali
                                </a>
                            </td>
                            <td>
                                <button class="btn bg-blue" onclick="openModal('modalMember{{ $a->id }}')">Edit
                                    Data</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 30px; color: #7f8c8d;">Belum ada anggota
                                aktif yang terdaftar.</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>

        <div id="TidakAktif" class="tab-content">
            <h3 style="color: #c0392b;">🔴 Daftar Anggota Non-Aktif (Cuti/Keluar)</h3>
            <div style="overflow-x: auto;">
                <table>
                    <tr>
                        <th>Nama & Sabuk</th>
                        <th>Tempat, Tgl Lahir</th>
                        <th>Umur / BB / TB / Baju</th>
                        <th>Orang Tua (No HP)</th>
                        <th>Dinonaktifkan</th>
                        <th>Prestasi</th>
                        <th>Aksi</th>
                    </tr>
                    @forelse($tidak_aktif as $t)
                        <tr class="data-row" style="background-color: #fafafa;">
                            <td>
                                <strong style="font-size: 15px; color: #000000ff;">{{ $t->nama }}</strong><br>
                                <span
                                    style="font-size: 12px; font-weight: bold; color: #ffffffff; background: #ff0000ff; padding: 2px 6px; border-radius: 4px; display: inline-block; margin-top: 5px;">
                                    {{ $t->sabuk }}
                                </span>
                            </td>
                            <td style="color: #000000ff; font-size: 13px;">
                                {{ $t->tempat_lahir }},<br>{{ \Carbon\Carbon::parse($t->tanggal_lahir)->format('d M Y') }}
                            </td>
                            <td style="color: #000000ff;">{{ \Carbon\Carbon::parse($t->tanggal_lahir)->age }} Thn |
                                {{ $t->berat_badan }}kg | {{ $t->tinggi_badan }}cm | {{ $t->ukuran_baju }}
                            </td>

                            <td style="font-size: 13px; line-height: 1.5; color: #000000ff;">
                                Ayah: {{ $t->nama_ayah }} (<a href="https://wa.me/{{ $t->no_hp_ayah }}" target="_blank" style="color:#25d366; text-decoration:none; font-weight:bold;">WA</a>)<br>
                                Ibu: {{ $t->nama_ibu }} (<a href="https://wa.me/{{ $t->no_hp_ibu }}" target="_blank" style="color:#25d366; text-decoration:none; font-weight:bold;">WA</a>)
                            </td>

                            <td style="color: #c0392b; font-weight: bold; font-size: 13px;">
                                {{ $t->tanggal_dinonaktifkan ? $t->tanggal_dinonaktifkan->format('d M Y') : '-' }}
                            </td>
                            <td>
                                <a href="/admin/anggota/{{ $t->id }}/prestasi" class="btn-prestasi"
                                    style="background: #95a5a6; box-shadow: none;">
                                    🏆 {{ $t->prestasi->count() }} Medali
                                </a>
                            </td>
                            <td>
                                <button class="btn bg-blue" onclick="openModal('modalMember{{ $t->id }}')">Edit
                                    Data</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 30px; color: #7f8c8d;">Tidak ada anggota
                                yang berstatus non-aktif.</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>


    <div id="modalTambahLangsung" class="modal">
        <div class="modal-box">
            <h3 style="margin-top:0; border-bottom: 2px solid #eee; padding-bottom:15px; color: #27ae60;">➕ Tambah
                Anggota</h3>
            <button type="button" class="btn bg-red" style="float: right; margin-top:-50px; padding: 6px 10px;"
                onclick="closeModal('modalTambahLangsung')">Tutup X</button>

            <form action="/admin/anggota" method="POST" enctype="multipart/form-data">
                @csrf

                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-input" required>

                <div style="display: flex; gap: 15px;">
                    <div style="flex: 1;">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-input" required>
                    </div>
                    <div style="flex: 1;">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-input" required>
                    </div>
                </div>

                <div style="display: flex; gap: 15px;">
                    <div style="flex: 1;">
                        <label class="form-label">Berat Badan (Kg)</label>
                        <input type="number" name="berat_badan" class="form-input" required>
                    </div>
                    <div style="flex: 1;">
                        <label class="form-label">Tinggi Badan (Cm)</label>
                        <input type="number" name="tinggi_badan" class="form-input" required>
                    </div>
                    <div style="flex: 1;">
                        <label class="form-label">Ukuran Baju</label>
                        <input type="text" name="ukuran_baju" class="form-input" required placeholder="S/M/L...">
                    </div>
                </div>

                <hr style="margin: 20px 0; border: 1px dashed #ccc;">

                <div style="display: flex; gap: 15px;">
                    <div style="flex: 1;">
                        <label class="form-label">Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="form-input" required>
                        <label class="form-label">No HP Ayah</label>
                        <input type="text" name="no_hp_ayah" class="form-input" required>
                    </div>
                    <div style="flex: 1;">
                        <label class="form-label">Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="form-input" required>
                        <label class="form-label">No HP Ibu</label>
                        <input type="text" name="no_hp_ibu" class="form-input" required>
                    </div>
                </div>

                <label class="form-label">Alamat Rumah Lengkap</label>
                <textarea name="alamat" class="form-input" rows="2" required></textarea>

                <hr style="margin: 20px 0; border: 1px dashed #ccc;">

                <label class="form-label">Tingkatan Sabuk Saat Ini</label>
                <select name="sabuk" class="form-input" style="cursor:pointer;" required>
                    <option value="Belum punya sabuk">Belum punya sabuk</option>
                    <option value="KYU VIII - SABUK PUTIH">KYU VIII - SABUK PUTIH</option>
                    <option value="KYU VII - SABUK KUNING">KYU VII - SABUK KUNING</option>
                    <option value="KYU VI - SABUK HIJAU">KYU VI - SABUK HIJAU</option>
                    <option value="KYU V - SABUK BIRU">KYU V - SABUK BIRU</option>
                    <option value="KYU IV - SABUK UNGU">KYU IV - SABUK UNGU</option>
                    <option value="KYU III - SABUK COKLAT">KYU III - SABUK COKLAT</option>
                    <option value="KYU II - SABUK COKLAT">KYU II - SABUK COKLAT</option>
                    <option value="KYU I - SABUK COKLAT">KYU I - SABUK COKLAT</option>
                    <option value="DAN I - SABUK HITAM">DAN I - SABUK HITAM</option>
                    <option value="DAN II - SABUK HITAM">DAN II - SABUK HITAM</option>
                    <option value="DAN III - SABUK HITAM">DAN III - SABUK HITAM</option>
                    <option value="DAN IV - SABUK HITAM">DAN IV - SABUK HITAM</option>
                </select>

                <div
                    style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-top: 15px; border: 1px dashed #27ae60;">
                    <label class="form-label" style="margin-top: 0;">Prestasi / Medali (Opsional)</label>
                    <input type="text" name="nama_prestasi" class="form-input"
                        placeholder="Contoh: Juara 1 Kumite O2SN">

                    <label class="form-label">Foto Bukti Prestasi (Maks 2MB)</label>
                    <input type="file" name="foto_prestasi" class="form-input" accept="image/*">
                </div>

                <button type="submit" class="btn bg-green"
                    style="width:100%; padding:12px; margin-top:25px; font-size:15px; border-radius:5px;">Simpan &
                    Masukkan ke Anggota Aktif</button>
            </form>
        </div>
    </div>


    @php
        $semua_anggota = $aktif->merge($tidak_aktif);
    @endphp

    @foreach($semua_anggota as $member)
        <div id="modalMember{{ $member->id }}" class="modal">
            <div class="modal-box">
                <h3 style="margin-top:0; border-bottom: 2px solid #eee; padding-bottom:15px; color: #2c3e50;">⚙️ Kelola:
                    {{ $member->nama }}
                </h3>
                <button type="button" class="btn bg-red" style="float: right; margin-top:-50px; padding: 6px 10px;"
                    onclick="closeModal('modalMember{{ $member->id }}')">Tutup X</button>

                <form action="/admin/anggota/{{ $member->id }}" method="POST">
                    @csrf @method('PUT')

                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-input" value="{{ $member->nama }}" required>

                    <div style="display: flex; gap: 15px;">
                        <div style="flex: 1;">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-input" value="{{ $member->tempat_lahir }}"
                                required>
                        </div>
                        <div style="flex: 1;">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-input"
                                value="{{ \Carbon\Carbon::parse($member->tanggal_lahir)->format('Y-m-d') }}" required>
                        </div>
                    </div>

                    <label class="form-label">Tingkatan Sabuk</label>
                    <select name="sabuk" class="form-input" style="cursor:pointer;" required>
                        <option value="Belum punya sabuk" {{ $member->sabuk == 'Belum punya sabuk' ? 'selected' : '' }}>Belum
                            punya sabuk</option>
                        <option value="KYU VIII - SABUK PUTIH" {{ $member->sabuk == 'KYU VIII - SABUK PUTIH' ? 'selected' : '' }}>KYU VIII - SABUK PUTIH</option>
                        <option value="KYU VII - SABUK KUNING" {{ $member->sabuk == 'KYU VII - SABUK KUNING' ? 'selected' : '' }}>KYU VII - SABUK KUNING</option>
                        <option value="KYU VI - SABUK HIJAU" {{ $member->sabuk == 'KYU VI - SABUK HIJAU' ? 'selected' : '' }}>
                            KYU VI - SABUK HIJAU</option>
                        <option value="KYU V - SABUK BIRU" {{ $member->sabuk == 'KYU V - SABUK BIRU' ? 'selected' : '' }}>KYU
                            V - SABUK BIRU</option>
                        <option value="KYU IV - SABUK UNGU" {{ $member->sabuk == 'KYU IV - SABUK UNGU' ? 'selected' : '' }}>
                            KYU IV - SABUK UNGU</option>
                        <option value="KYU III - SABUK COKLAT" {{ $member->sabuk == 'KYU III - SABUK COKLAT' ? 'selected' : '' }}>KYU III - SABUK COKLAT</option>
                        <option value="KYU II - SABUK COKLAT" {{ $member->sabuk == 'KYU II - SABUK COKLAT' ? 'selected' : '' }}>KYU II - SABUK COKLAT</option>
                        <option value="KYU I - SABUK COKLAT" {{ $member->sabuk == 'KYU I - SABUK COKLAT' ? 'selected' : '' }}>
                            KYU I - SABUK COKLAT</option>
                        <option value="DAN I - SABUK HITAM" {{ $member->sabuk == 'DAN I - SABUK HITAM' ? 'selected' : '' }}>
                            DAN I - SABUK HITAM</option>
                        <option value="DAN II - SABUK HITAM" {{ $member->sabuk == 'DAN II - SABUK HITAM' ? 'selected' : '' }}>
                            DAN II - SABUK HITAM</option>
                        <option value="DAN III - SABUK HITAM" {{ $member->sabuk == 'DAN III - SABUK HITAM' ? 'selected' : '' }}>DAN III - SABUK HITAM</option>
                        <option value="DAN IV - SABUK HITAM" {{ $member->sabuk == 'DAN IV - SABUK HITAM' ? 'selected' : '' }}>
                            DAN IV - SABUK HITAM</option>
                    </select>

                    <div style="display: flex; gap: 15px;">
                        <div style="flex: 1;">
                            <label class="form-label">Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="form-input" value="{{ $member->nama_ayah }}" required>
                            <label class="form-label">No HP Ayah</label>
                            <input type="text" name="no_hp_ayah" class="form-input" value="{{ $member->no_hp_ayah }}">
                        </div>
                        <div style="flex: 1;">
                            <label class="form-label">Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-input" value="{{ $member->nama_ibu }}" required>
                            <label class="form-label">No HP Ibu</label>
                            <input type="text" name="no_hp_ibu" class="form-input" value="{{ $member->no_hp_ibu }}">
                        </div>
                    </div>

                    <label class="form-label">Status Keanggotaan</label>
                    <select name="status" class="form-input" style="font-weight:bold; cursor:pointer;">
                        <option value="aktif" {{ $member->status == 'aktif' ? 'selected' : '' }}>🟢 AKTIF</option>
                        <option value="tidak_aktif" {{ $member->status == 'tidak_aktif' ? 'selected' : '' }}>🔴 TIDAK AKTIF
                            (Cuti/Keluar)</option>
                    </select>

                    <label class="form-label">Ukuran Baju</label>
                    <input type="text" name="ukuran_baju" class="form-input" value="{{ $member->ukuran_baju }}" required>

                    <label class="form-label">Alamat Rumah Baru</label>
                    <textarea name="alamat" class="form-input" rows="2">{{ $member->alamat }}</textarea>

                    <button type="submit" class="btn bg-blue"
                        style="width:100%; padding:12px; margin-top:25px; font-size:15px; border-radius:5px;">Simpan
                        Perubahan Data</button>
                </form>
            </div>
        </div>
    @endforeach

    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
</body>

</html>