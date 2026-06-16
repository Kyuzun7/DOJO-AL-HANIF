<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $artikel->title }} - DOJO AL-HANIF</title>
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
            <a href="/admin/artikel/{{ $artikel->id }}/edit" class="btn bg-blue" style="padding: 10px 20px; font-weight: bold; text-decoration: none; color: black;">✏️ Edit Artikel Ini</a>
        </div>
    @endauth

    <div class="pr-detail-container">
        <h1 class="pr-detail-title">{{ $artikel->title }}</h1>
        <div class="pr-detail-meta">
            <i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($artikel->published_date)->format('d F Y') }}
        </div>

        @if($artikel->cover_image)
            <img src="{{ Storage::url($artikel->cover_image) }}" alt="{{ $artikel->title }}" class="pr-detail-cover">
        @endif

        <div class="pr-detail-content">
            {!! $artikel->content !!}
        </div>

        <a href="/artikel" class="pr-back-btn">&larr; Kembali ke Daftar Artikel</a>
    </div>

    <!-- Layout Footer based on image -->
    @include('partials.footer')
</body>
</html>
