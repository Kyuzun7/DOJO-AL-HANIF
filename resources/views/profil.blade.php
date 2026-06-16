<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Anggota - DOJO AL-HANIF</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600;700&family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/beranda/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/beranda/profil-anggota.css') }}">
</head>
<body>
    @include('partials.navbar')

    <section class="profil-header-section">
        <h1 class="profil-title">PROFIL ANGGOTA</h1>
    </section>

    <div class="profil-container">
        <!-- Search Bar -->
        <div style="margin-bottom: 20px;">
            <div style="position: relative; max-width: 350px; margin-left: auto;">
                <input type="text" id="searchInput" placeholder="Cari nama anggota..." style="width: 100%; padding: 12px 15px; padding-left: 40px; border: 1px solid #ccc; border-radius: 8px; font-family: 'Inter', sans-serif; font-size: 1rem; box-sizing: border-box; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <i class="fas fa-search" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #999;"></i>
            </div>
        </div>

        <table class="profil-table" id="memberTable">
            <thead>
                <tr>
                    <th style="width: 35%;">NAMA</th>
                    <th style="width: 20%;">NO. ANGGOTA</th>
                    <th style="width: 25%;">TINGKATAN</th>
                    <th style="width: 20%;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groupedMembers as $beltName => $members)
                    <tr class="belt-row">
                        <td colspan="4">{{ $beltName }}</td>
                    </tr>
                    @foreach($members as $m)
                    <tr>
                        <td data-label="NAMA">
                            <a href="/profil-anggota/{{ $m->id }}" style="text-decoration: none; color: #b31b1b; font-weight: 700;">
                                {{ strtoupper($m->nama) }}
                            </a>
                        </td>
                        <td data-label="NO. ANGGOTA">{{ $m->nomor_anggota ?? '-' }}</td>
                        <td data-label="TINGKATAN">{{ strtoupper($m->tingkatan_sabuk) === 'TINGKATAN' ? 'TINGKATAN' : strtoupper($m->tingkatan_sabuk) }}</td>
                        <td data-label="STATUS">
                            <span class="status-badge {{ $m->status == 'aktif' ? 'status-aktif' : 'status-nonaktif' }}">
                                {{ strtoupper(str_replace('_', '', $m->status)) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                @endforeach

                @if(empty($groupedMembers))
                <tr>
                    <td colspan="4" style="text-align: center; padding: 30px; background-color: #fff;">Belum ada anggota yang terdaftar dengan sabuk.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Layout Footer based on image -->
    @include('partials.footer')

    <script src="{{ asset('js/beranda/profil.js') }}"></script>
</body>
</html>
