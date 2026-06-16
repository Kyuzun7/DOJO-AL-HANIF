<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel & Kegiatan - DOJO AL-HANIF</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600;700&family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/beranda/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/beranda/artikel.css') }}">
</head>
<body>
    @include('partials.navbar')

    @auth
        <div style="background-color: #f1f1f1; padding: 15px; text-align: center; border-bottom: 2px solid #ddd;">
            <span style="margin-right: 15px; font-weight: bold; color: #333;">✓ Mode Admin Aktif</span>
            <a href="/admin/artikel/create" class="btn bg-green" style="padding: 10px 20px; font-weight: bold; text-decoration: none; color: black;">+ Buat Artikel Baru</a>
        </div>
    @endauth

    <section class="artikel-header-section">
        <h1 class="artikel-title">ARTIKEL & KEGIATAN</h1>
        <p style="color: #666; font-family: 'Inter', sans-serif; margin-top: 10px;">Berita terbaru dan pengumuman kegiatan resmi dari Dojo Al-Hanif.</p>
        <div style="margin-top: 20px;">
            <a href="/" style="display: inline-block; padding: 10px 25px; background: #b31b1b; color: white; text-decoration: none; border-radius: 25px; font-weight: bold; font-family: 'Inter', sans-serif; transition: 0.3s;"><i class="fas fa-home"></i> Kembali ke Beranda</a>
        </div>
    </section>

    <div class="artikel-container">
        @forelse($artikels as $artikel)
            <div class="artikel-card">
                @if($artikel->cover_image)
                    <img src="{{ Storage::url($artikel->cover_image) }}" alt="{{ $artikel->title }}" class="artikel-card-img">
                @else
                    <div class="artikel-card-img" style="display:flex; align-items:center; justify-content:center; color:#aaa; font-size: 3rem;">
                        <i class="fas fa-newspaper"></i>
                    </div>
                @endif
                <div class="artikel-card-body">
                    <div class="artikel-card-date">{{ \Carbon\Carbon::parse($artikel->published_date)->format('d F Y') }}</div>
                    <h3 class="artikel-card-title">{{ $artikel->title }}</h3>
                    <div class="artikel-card-excerpt">
                        {{ \Illuminate\Support\Str::words(strip_tags($artikel->content), 20, '...') }}
                    </div>
                    <a href="/artikel/{{ $artikel->slug }}" class="artikel-card-btn">Baca Selengkapnya</a>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 50px; color: #888;">
                <h3>Belum ada artikel yang dipublikasikan.</h3>
            </div>
        @endforelse
    </div>

    <!-- Layout Footer based on image -->
    @include('partials.footer')
</body>
</html>
