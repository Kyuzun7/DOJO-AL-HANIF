<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin - DOJO AL-HANIF</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        .badge { padding: 4px 8px; border-radius: 4px; font-weight: bold; color: white; font-size: 12px; }
        .tier_0 { background-color: #e74c3c; }
        .tier_1 { background-color: #f39c12; }
        .tier_2 { background-color: #3498db; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Profil Admin & Hak Akses</h2>
        <a href="/dashboard" class="link-back">&larr; Kembali ke Dashboard Utama</a>

        @if(session('success'))
            <div class="alert-success" style="font-weight: bold; margin-bottom: 20px; color: green;">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error" style="font-weight: bold; margin-bottom: 20px; color: red;">✗ {{ session('error') }}</div>
        @endif

        @if(auth()->user()->role !== 'tier_2')
        <div style="margin-top: 20px;">
            <a href="/admin/profile/create" class="btn bg-green" style="text-decoration: none; display: inline-block;">+ Tambah Admin Baru</a>
        </div>
        @endif

        <div style="overflow-x: auto;">
            <table>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Peran (Tier)</th>
                    <th>Aksi</th>
                </tr>
                @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->username }}</td>
                    <td><span class="badge {{ $admin->role }}">{{ strtoupper(str_replace('_', ' ', $admin->role)) }}</span></td>
                    <td>
                        @if(
                            auth()->user()->role === 'tier_0' || 
                            (auth()->user()->role === 'tier_1' && $admin->role === 'tier_2') || 
                            auth()->user()->id === $admin->id
                        )
                        <a href="/admin/profile/{{ $admin->id }}/edit" class="btn bg-blue" style="text-decoration: none; padding: 5px 10px;">Edit</a>
                        @endif

                        @if(
                            (auth()->user()->role === 'tier_0' && auth()->user()->id !== $admin->id) ||
                            (auth()->user()->role === 'tier_1' && $admin->role === 'tier_2')
                        )
                        <form action="/admin/profile/{{ $admin->id }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus admin ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn bg-red" style="padding: 5px 10px;">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
</html>
