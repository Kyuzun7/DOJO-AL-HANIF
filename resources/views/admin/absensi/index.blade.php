<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Anggota</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <h2>Absensi Anggota</h2>
        <div style="margin-bottom: 20px; display: flex; flex-direction: column; gap: 10px; align-items: flex-start;">
            <a href="/dashboard" class="link-back" style="margin-right: 15px; margin-bottom: 0;">&larr; Kembali ke Dashboard</a>
            <a href="/admin/absensi/rekap" class="btn bg-blue" style="text-decoration: none; padding: 8px 15px; border-radius: 5px; width: auto;">Lihat Rekapitulasi & Ekspor Excel</a>
        </div>

        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 10px; margin-top: 15px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="background: white; padding: 20px; border-radius: 8px; margin-top: 20px;">
            <form action="/admin/absensi" method="GET" style="margin-bottom: 20px; display: flex; gap: 10px; align-items: center;">
                <label>Pilih Tanggal:</label>
                <input type="date" name="tanggal" value="{{ $tanggal }}" class="form-input" style="width: auto;">
                <button type="submit" class="btn bg-blue">Tampilkan</button>
            </form>

            <form action="/admin/absensi" method="POST">
                @csrf
                <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; margin-top: 20px; min-width: 600px;">
                        <tr style="background: #f4f4f4;">
                            <th style="padding: 10px; border: 1px solid #ddd;">No</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Nama Anggota</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Sabuk</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Status Kehadiran</th>
                        </tr>
                        @foreach($members as $index => $member)
                            @php
                                $currentStatus = isset($absensi[$member->id]) ? $absensi[$member->id]->status : 'hadir';
                            @endphp
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $index + 1 }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $member->nama }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $member->sabuk }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">
                                <div class="radio-group" style="display: flex; flex-wrap: wrap; gap: 15px;">
                                    <label><input type="radio" name="status[{{ $member->id }}]" value="hadir" {{ $currentStatus == 'hadir' ? 'checked' : '' }}> Hadir</label>
                                    <label><input type="radio" name="status[{{ $member->id }}]" value="izin" {{ $currentStatus == 'izin' ? 'checked' : '' }}> Izin</label>
                                    <label><input type="radio" name="status[{{ $member->id }}]" value="sakit" {{ $currentStatus == 'sakit' ? 'checked' : '' }}> Sakit</label>
                                    <label><input type="radio" name="status[{{ $member->id }}]" value="alfa" {{ $currentStatus == 'alfa' ? 'checked' : '' }}> Alfa</label>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn bg-blue" style="width: 100%; padding: 12px; font-size: 16px;">Simpan Absensi</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
