<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Press Release - DOJO AL-HANIF</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <h2>Kelola Press Release</h2>
        <a href="/dashboard" class="link-back">&larr; Kembali ke Dashboard Utama</a>

        @if(session('success'))
            <div class="alert-success" style="font-weight: bold; margin-bottom: 20px; color: #27ae60; background: #e8f8f5; padding: 10px; border-radius: 5px;">✓ {{ session('success') }}</div>
        @endif

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h3 style="color: #2c3e50; margin: 0;">📰 Daftar Artikel</h3>
            <a href="/admin/artikel/create" class="btn bg-green" style="text-decoration: none; padding: 10px 15px; font-size: 14px; display: inline-block;">
                + Tambah Artikel
            </a>
        </div>

        <div style="overflow-x: auto;">
            <table>
                <tr>
                    <th>Judul</th>
                    <th>Tgl Publikasi</th>
                    <th>Cover</th>
                    <th>Aksi</th>
                </tr>
                @forelse($pressReleases as $pr)
                <tr class="data-row">
                    <td><strong>{{ $pr->title }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($pr->published_date)->format('d M Y') }}</td>
                    <td>
                        @if($pr->cover_image)
                            <img src="{{ Storage::url($pr->cover_image) }}" alt="Cover" style="height: 50px; border-radius: 4px;">
                        @else
                            <span style="color: #999;">Tidak ada</span>
                        @endif
                    </td>
                    <td>
                        <a href="/admin/artikel/{{ $pr->id }}/edit" class="btn bg-blue" style="text-decoration: none; display: inline-block;">Edit</a>
                        
                        <form action="/admin/artikel/{{ $pr->id }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus artikel ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn bg-red" style="margin-top: 5px;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 30px; color: #7f8c8d;">Belum ada press release.</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</body>
</html>
