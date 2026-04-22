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
        <table class="profil-table">
            <thead>
                <tr>
                    <th style="width: 50%;">NAMA</th>
                    <th style="width: 25%;">TINGKATAN</th>
                    <th style="width: 25%;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groupedMembers as $beltName => $members)
                    <tr class="belt-row">
                        <td colspan="3">{{ $beltName }}</td>
                    </tr>
                    @foreach($members as $m)
                    <tr>
                        <td data-label="NAMA">{{ strtoupper($m->nama) }}</td>
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
                    <td colspan="3" style="text-align: center; padding: 30px; background-color: #fff;">Belum ada anggota yang terdaftar dengan sabuk.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Layout Footer based on image -->
    <footer class="large-footer">
        <div class="footer-grid">
            <div class="footer-col">
                <div class="footer-logo-title">DOJO AL-HANIF</div>
                <p>Pusat pelatihan karate modern yang mengedepankan nilai sportivitas dan keunggulan karakter di setiap gerakan.</p>
            </div>
            <div class="footer-col" style="padding-left: 20px;">
                <h4>QUICK LINKS</h4>
                <ul>
                    <li><a href="/">BERANDA</a></li>
                    <li><a href="#">ARTIKEL</a></li>
                    <li><a href="#">KEGIATAN</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>CONTACT</h4>
                <p>JL. GELA DIRI NO. 123<br>JAKARTA, INDONESIA<br>+62 21 098 7182<br>INFO@DOJOALHANIF.COM</p>
            </div>
            <div class="footer-col">
                <h4>SOSMED</h4>
                <div class="social-icons">
                    <a href="#"><i class="fas fa-globe"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
                <button class="btn-newsletter">NEWSLETTER INFO</button>
            </div>
        </div>
        <div class="footer-bottom">
            <div>&copy; 2024 DOJO AL-HANIF. ALL RIGHTS RESERVED.</div>
            <div class="footer-bottom-links">
                <a href="#">GUIDELINES</a>
                <a href="#">PRICING</a>
                <a href="#">SOCIAL MEDIA</a>
                <a href="#">CLEAR</a>
            </div>
        </div>
    </footer>
</body>
</html>
