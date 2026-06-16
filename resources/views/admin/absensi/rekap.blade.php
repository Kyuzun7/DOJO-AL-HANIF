<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi Anggota</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <h2>Rekapitulasi Absensi</h2>
        <div style="margin-bottom: 20px; display: flex; flex-direction: column; gap: 10px; align-items: flex-start;">
            <a href="/admin/absensi" class="link-back" style="margin-right: 15px; margin-bottom: 0;">&larr; Kembali ke Daftar Absensi</a>
            <a href="/admin/absensi/export?bulan={{ $bulan }}&tahun={{ $tahun }}" class="btn bg-green" style="background: #27ae60; text-decoration: none; padding: 8px 15px; border-radius: 5px; color: white; font-weight: bold; width: auto;">
                <i class="fas fa-file-excel"></i> Ekspor ke Excel (CSV)
            </a>
        </div>

        <div style="background: white; padding: 20px; border-radius: 8px; margin-top: 20px;">
            <form action="/admin/absensi/rekap" method="GET" style="margin-bottom: 20px; display: flex; gap: 10px; align-items: center;">
                <label>Bulan:</label>
                <select name="bulan" class="form-input" style="width: auto;">
                    @php
                        $months = [
                            '01' => 'Januari',
                            '02' => 'Februari',
                            '03' => 'Maret',
                            '04' => 'April',
                            '05' => 'Mei',
                            '06' => 'Juni',
                            '07' => 'Juli',
                            '08' => 'Agustus',
                            '09' => 'September',
                            '10' => 'Oktober',
                            '11' => 'November',
                            '12' => 'Desember'
                        ];
                    @endphp
                    @foreach($months as $num => $name)
                        <option value="{{ $num }}" {{ $bulan == $num ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
                <label>Tahun:</label>
                <select name="tahun" class="form-input" style="width: auto;">
                    @for($i=date('Y')-2; $i<=date('Y')+1; $i++)
                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                <button type="submit" class="btn bg-blue">Tampilkan</button>
            </form>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; margin-top: 20px; min-width: 800px;">
                    <tr style="background: #f4f4f4;">
                        <th style="padding: 10px; border: 1px solid #ddd;">No</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Nama Anggota</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Sabuk</th>
                        <th style="padding: 10px; border: 1px solid #ddd; text-align: center; color: green;">Hadir</th>
                        <th style="padding: 10px; border: 1px solid #ddd; text-align: center; color: orange;">Izin</th>
                        <th style="padding: 10px; border: 1px solid #ddd; text-align: center; color: blue;">Sakit</th>
                        <th style="padding: 10px; border: 1px solid #ddd; text-align: center; color: red;">Alfa</th>
                    </tr>
                    @foreach($rekap as $index => $r)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $index + 1 }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">{{ $r['nama'] }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $r['sabuk'] }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center; font-weight: bold; color: green;">
                            {{ $r['hadir'] }} <br><small style="color:#666;">{{ $r['detail_hadir'] ? '('.$r['detail_hadir'].')' : '' }}</small>
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center; font-weight: bold; color: orange;">
                            {{ $r['izin'] }} <br><small style="color:#666;">{{ $r['detail_izin'] ? '('.$r['detail_izin'].')' : '' }}</small>
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center; font-weight: bold; color: blue;">
                            {{ $r['sakit'] }} <br><small style="color:#666;">{{ $r['detail_sakit'] ? '('.$r['detail_sakit'].')' : '' }}</small>
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center; font-weight: bold; color: red;">
                            {{ $r['alfa'] }} <br><small style="color:#666;">{{ $r['detail_alfa'] ? '('.$r['detail_alfa'].')' : '' }}</small>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</body>
</html>
