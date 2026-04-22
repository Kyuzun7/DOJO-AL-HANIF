<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pressRelease->title }} - DOJO AL-HANIF</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600;700&family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/beranda/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/beranda/show-artikel.css') }}">
</head>
<body>
    @include('partials.navbar')

    @auth
        <div style="background-color: #f1f1f1; padding: 15px; text-align: center; border-bottom: 2px solid #ddd;">
            <span style="margin-right: 15px; font-weight: bold; color: #333;">✓ Mode Admin Aktif</span>
            <a href="/admin/artikel/{{ $pressRelease->id }}/edit" class="btn bg-blue" style="padding: 10px 20px; font-weight: bold; text-decoration: none; color: black;">✏️ Edit Artikel Ini</a>
        </div>
    @endauth

    <div class="pr-detail-container">
        <h1 class="pr-detail-title">{{ $pressRelease->title }}</h1>
        <div class="pr-detail-meta">
            <i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($pressRelease->published_date)->format('d F Y') }}
        </div>

        @if($pressRelease->cover_image)
            <img src="{{ Storage::url($pressRelease->cover_image) }}" alt="{{ $pressRelease->title }}" class="pr-detail-cover">
        @endif

        <div class="pr-detail-content">
            {!! $pressRelease->content !!}
        </div>

        <a href="/artikel" class="pr-back-btn">&larr; Kembali ke Daftar Artikel</a>
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
                    <li><a href="/artikel">ARTIKEL</a></li>
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
