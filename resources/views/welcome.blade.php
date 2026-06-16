<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda DOJO AL-HANIF</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/beranda/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/beranda/popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/beranda/agenda.css') }}">
</head>
<body>

    <!-- NAVBAR -->
    @include('partials.navbar')

    <!-- HERO SECTION -->
    <section class="hero-section" style="background-image: url('{{ asset('img/background.jpeg') }}');">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">
                Selamat Datang<br>
                Di <span class="text-accent">DOJO AL-HANIF</span>
            </h1>
            <p class="hero-subtitle">
               Karate melatih fisik, disiplin, dan bela diri untuk membentuk karakter tangguh yang berakhlak mulia.
               Bersama <b>Dojo Al-Hanif,</b> mari tumbuh lebih sehat, tangguh, dan berprestasi.
            </p>
            <div class="hero-buttons">
                @auth
                    <a href="/dashboard" class="btn btn-white">MASUK DASHBOARD</a>
                    <form action="/logout" method="POST" style="display: inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-outline-red">KELUAR AKUN</button>
                    </form>
                @else
                    <a href="/daftar" class="btn btn-white">DAFTAR SEKARANG</a>
                    <a href="#sejarah" class="btn btn-outline-red">TENTANG KAMI</a>
                @endauth
            </div>
            
            @if(session('success'))
                <div style="background: rgba(212, 237, 218, 0.9); border-left: 5px solid #28a745; color: #155724; padding: 15px; margin-top: 30px; max-width: 400px; border-radius: 4px;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
        </div>
    </section>

    <!-- SEJARAH SECTION -->
    <section id="sejarah" class="section-padding">
        <div class="container sejarah-grid">
            <div class="sejarah-text">
                <span class="section-subtitle">WARISAN SEJARAH</span>
                <h2 class="section-title" style="margin-bottom: 20px;">SEJARAH</h2>
                <p>
                    Dojo Al-Hanif didirikan pada tahun 2015 sebagai wujud komitmen dalam membina generasi muda melalui seni bela diri karate. Pada awal perjalanannya, Dojo Al-Hanif mengadopsi aliran KASIDO sebagai dasar pembinaan teknik dan karakter para karateka. Selama beberapa tahun, dojo ini tumbuh dan berkembang dengan penuh semangat, menanamkan nilai disiplin, keberanian, serta sportivitas kepada para anggotanya.
                </p>
                <p>Seiring berjalannya waktu dan berbagai dinamika yang terjadi dalam organisasi, pada tahun 2021 aliran KASIDO secara resmi ditutup. Momen ini menjadi titik penting sekaligus peluang untuk melakukan pembaruan arah dan identitas dojo. Dengan penuh keyakinan dan semangat kembali kepada akar, Dojo Al-Hanif kemudian beralih dan kembali kepada aliran KEI SHIN KAN—sebuah aliran yang memiliki nilai historis dan emosional bagi pendirinya, Mulyono, yang sebelumnya pernah menimba ilmu dan berkembang dalam aliran tersebut.
                </p>
                <p>
                    Langkah ini tidak hanya sekadar perubahan aliran, tetapi juga menjadi upaya untuk memperkuat kualitas pembinaan serta menjaga kemurnian nilai-nilai karate yang berlandaskan teknik, etika, dan pembentukan akhlak. Pada tahun yang sama, Dojo Al-Hanif secara resmi bergabung dengan Pengurus Provinsi (Pengprov) Jawa Barat, sehingga keberadaannya semakin diakui secara organisatoris dan memiliki landasan yang kuat dalam struktur pembinaan olahraga karate di tingkat daerah.
                </p>
                <p>
                    Sejak saat itu, Dojo Al-Hanif berkembang menjadi salah satu cikal bakal dan pusat pengembangan aliran KEI SHIN KAN di Kabupaten Bekasi. Dengan semangat kebersamaan, profesionalisme, dan dedikasi tinggi, dojo ini terus berkomitmen mencetak atlet-atlet berprestasi yang tidak hanya unggul dalam kompetisi, tetapi juga memiliki karakter kuat, menjunjung tinggi sumpah karate, serta berakhlak mulia.
                </p>
                <p>
                    Hingga saat ini, Dojo Al-Hanif terus melangkah maju, menjadi wadah pembinaan yang tidak hanya berfokus pada kemampuan fisik, tetapi juga pada pembentukan mental dan spiritual, demi melahirkan generasi karateka yang tangguh dan berintegritas.
                </p>
            
            </div>
            <div class="sejarah-image">
                <img src="{{ asset('img/sejarohh.jpeg') }}" alt="Sejarah Dojo Al-Hanif">
            </div>
        </div>
    </section>

    <!-- VISI & MISI SECTION -->
    <section class="section-padding visi-misi-section">
        <div class="container">
            <h2 class="section-title">VISI & MISI</h2>
            <div class="vm-grid">
                <div class="visi-box">
                    <h3>VISI</h3>
                    <p>Mewujudkan Semua Anggota karate yang berprestasi, sehat jasmani dan rohani, teguh memegang janji serta sumpah karate, dan berakhlak mulia.</p>
                </div>
                <div class="misi-wrapper">
                    <h3>MISI</h3>
                    <div class="misi-grid">
                        <div class="misi-item">
                            <span class="misi-num">01</span>
                            <p>Menyelenggarakan latihan karate secara disiplin, terarah, dan berkelanjutan untuk meningkatkan prestasi atlet.</p>
                        </div>
                        <div class="misi-item">
                            <span class="misi-num">02</span>
                            <p>Membina kesehatan fisik dan mental anggota melalui program latihan yang seimbang dan profesional.</p>
                        </div>
                        <div class="misi-item">
                            <span class="misi-num">03</span>
                            <p>Menanamkan nilai-nilai sumpah karate dalam setiap aktivitas latihan dan kehidupan sehari-hari.</p>
                        </div>
                        <div class="misi-item">
                            <span class="misi-num">04</span>
                            <p>Membentuk karakter atlet yang jujur, bertanggung jawab, dan berakhlak baik.</p>
                        </div>
                        <div class="misi-item">
                            <span class="misi-num">05</span>
                            <p>Mendorong partisipasi atlet dalam berbagai kejuaraan untuk mengasah kemampuan dan mental bertanding.</p>
                        </div>
                        <div class="misi-item">
                            <span class="misi-num">06</span>
                            <p>Membangun lingkungan dojo yang solid, saling menghormati, dan menjunjung tinggi sportivitas.</p>
                        </div>
                         <div class="misi-item">
                            <span class="misi-num">07</span>
                            <p>Menjalin kerja sama dengan orang tua, sekolah, dan pihak terkait untuk mendukung perkembangan atlet.</p>
                        </div>
                         <!-- <div class="misi-item">
                            <span class="misi-num">08</span>
                            <p>Menumbuhkan loyalitas (Chugi) kepada guru dan rekan sejawat.</p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TUJUAN SECTION -->
    <section class="section-padding tujuan-wrapper">
        <div class="container">
            <div class="tujuan-section">
                <h2 class="section-title" style="margin-bottom: 30px;">TUJUAN</h2>
                <div class="tujuan-grid">
                    <div class="tujuan-item">
                        <span class="tujuan-num">1</span>
                        <p>Menghasilkan atlet karate yang mampu meraih prestasi di tingkat daerah, nasional, hingga internasional.</p>
                    </div>
                    <div class="tujuan-item">
                        <span class="tujuan-num">2</span>
                        <p>Membentuk anggota yang memiliki kondisi fisik yang kuat, sehat, dan bugar serta mental yang tangguh.</p>
                    </div>
                    <div class="tujuan-item">
                        <span class="tujuan-num">3</span>
                        <p>Menanamkan dan mengamalkan nilai-nilai sumpah karate dalam kehidupan sehari-hari.</p>
                    </div>
                    <div class="tujuan-item">
                        <span class="tujuan-num">4</span>
                        <p>Membentuk pribadi yang disiplin, jujur, bertanggung jawab, dan berakhlak mulia.</p>
                    </div>
                    <div class="tujuan-item">
                        <span class="tujuan-num">5</span>
                        <p>Mengembangkan kemampuan teknik, strategi, dan mental bertanding secara optimal.</p>
                    </div>
                    <div class="tujuan-item">
                        <span class="tujuan-num">6</span>
                        <p>Menciptakan lingkungan latihan yang aman, nyaman, dan penuh semangat kebersamaan.</p>
                    </div>
                    <div class="tujuan-item">
                        <span class="tujuan-num">7</span>
                        <p>Meningkatkan rasa percaya diri, sportivitas, dan jiwa kepemimpinan pada setiap anggota.</p>
                    </div>
                    <div class="tujuan-item">
                        <span class="tujuan-num">8</span>
                        <p>Menjadi wadah pembinaan generasi muda yang positif dan produktif melalui olahraga karate.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BENEFIT SECTION -->
    <section class="section-padding benefit-wrapper">
        <div class="container">
            <div class="benefit-section" style="margin-top: 0;">
                <h2 class="section-title">MANFAAT</h2>
                <div class="benefit-grid" style="margin-top: 30px;">
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-star"></i></div>
                        <h3>PRESTASI</h3>
                        <p>Bukan sekadar menang lomba, tapi untuk melatih disiplin dan membentuk mental tangguh yang pantang menyerah serta jujur (sportif).</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-bullseye"></i></div>
                        <h3>BELA DIRI</h3>
                        <p>Agar punya kemampuan melindungi diri saat bahaya. Namun, poin pentingnya adalah pengendalian diri, sehingga tidak sembarangan menggunakan kekuatan dan tidak mudah terpancing emosi.</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-shield-alt"></i></div>
                        <h3>KESEHATAN</h3>
                        <p>Membuat tubuh lebih kuat, lincah, dan bugar. Selain fisik jadi sehat, karate juga bermanfaat untuk mengurangi stres dan melatih fokus pikiran.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TEMPAT LATIHAN & JADWAL SECTION -->
    <section class="section-padding tempat-latihan-section" style="background: #fdfdfd;">
        <div class="container">
            <h2 class="section-title" style="text-align: center; margin-bottom: 40px;">TEMPAT & JADWAL LATIHAN</h2>
            <div style="display: flex; flex-wrap: wrap; gap: 40px; align-items: stretch;">
                
                <!-- MAPS -->
                <div style="flex: 1; min-width: 300px; display: flex; flex-direction: column;">
                    <a href="https://maps.app.goo.gl/BK1L5HAc82auVXNM7" target="_blank" class="maps-container" style="margin-top: 0; flex: 1; height: 100%; min-height: 350px;">
                        <div class="maps-content">
                            <i class="fas fa-map-location-dot"></i>
                            <p>Klik untuk membuka lokasi kami di Google Maps</p>
                        </div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.5626969057434!2d107.0169!3d-6.2349!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698a8f8f8f8f8f%3A0x8f8f8f8f8f8f8f8f!2sDojo%20Al-Hanif!5e0!3m2!1sid!2sid!4v1234567890" width="100%" height="100%" style="border:0; min-height: 350px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </a>
                </div>

                <!-- JADWAL TIMELINE -->
                <div style="flex: 1; min-width: 300px; display: flex; flex-direction: column;">
                    <div class="jadwal-timeline-wrapper" style="background: white; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); padding: 30px 10px; flex: 1; display: flex; align-items: center; border: 1px solid #eee; overflow: hidden;">
                        <div class="jadwal-timeline">
                            <svg class="timeline-zigzag-line" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; pointer-events: none;">
                                <polyline points="7.14%,38 21.42%,78 35.71%,38 50%,78 64.28%,38 78.57%,78 92.85%,38" fill="none" stroke="#d32f2f" stroke-width="3" stroke-linejoin="round"/>
                            </svg>
                            @php
                                $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                            @endphp
                            @foreach($days as $day)
                                @php
                                    $jadwalHariIni = $jadwals->where('hari', $day);
                                @endphp
                                <div class="timeline-node">
                                    <div class="timeline-day">{{ $day }}</div>
                                    <div class="timeline-circle {{ $jadwalHariIni->isNotEmpty() ? 'active' : '' }}"></div>
                                    <div class="timeline-times">
                                        @if($jadwalHariIni->isNotEmpty())
                                            @foreach($jadwalHariIni as $j)
                                                <div class="timeline-time">{{ \Carbon\Carbon::parse($j->jam_mulai)->format('H.i') }}</div>
                                            @endforeach
                                        @else
                                            <div class="timeline-time empty">-</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SLIDER AGENDA KEGIATAN -->
    <section class="agenda-slider-section">
        <div class="container">
            <span class="section-subtitle" style="text-align: center; display: block;">KEGIATAN MENDATANG</span>
            <h2 class="section-title" style="text-align: center; margin-bottom: 40px;">AGENDA KEGIATAN</h2>
            
            <div class="agenda-slider-container" id="agendaSliderContainer">
                <div class="agenda-slider-track {{ $kegiatans->count() < 3 ? 'track-centered' : '' }}" id="agendaSliderTrack">
                    @forelse($kegiatans as $keg)
                        <div class="agenda-card {{ $kegiatans->count() == 1 ? 'card-single' : '' }}">
                            <a href="/kegiatan/{{ $keg->slug }}">
                                @if($keg->flyer_image)
                                    <img src="{{ Storage::url($keg->flyer_image) }}" alt="{{ $keg->title }}">
                                @else
                                    <div class="agenda-card-placeholder">
                                        <i class="fas fa-calendar-alt"></i>
                                        <h4 style="margin: 0; font-family: 'Montserrat', sans-serif;">{{ strtoupper($keg->title) }}</h4>
                                        <p style="font-size: 0.8rem; margin-top: 10px; color: #aaa;">{{ \Carbon\Carbon::parse($keg->event_date)->format('d M Y') }}</p>
                                    </div>
                                @endif
                            </a>
                        </div>
                    @empty
                        <div class="agenda-card" style="flex: 0 0 100%;">
                            <div class="agenda-card-placeholder coming-soon-card">
                                <i class="fas fa-hourglass-half"></i>
                                <h3 style="margin: 0; font-family: 'Montserrat', sans-serif;">SEGERA HADIR</h3>
                                <p style="margin-top: 10px; color: #aaa;">Nantikan agenda kegiatan seru lainnya dari Dojo Al-Hanif!</p>
                            </div>
                        </div>
                    @endforelse

                    @if($kegiatans->count() >= 3)
                        {{-- Duplikasi untuk infinite loop --}}
                        @foreach($kegiatans as $keg)
                            <div class="agenda-card">
                                <a href="/kegiatan/{{ $keg->slug }}">
                                    @if($keg->flyer_image)
                                        <img src="{{ Storage::url($keg->flyer_image) }}" alt="{{ $keg->title }}">
                                    @else
                                        <div class="agenda-card-placeholder">
                                            <i class="fas fa-calendar-alt"></i>
                                            <h4 style="margin: 0; font-family: 'Montserrat', sans-serif;">{{ strtoupper($keg->title) }}</h4>
                                            <p style="font-size: 0.8rem; margin-top: 10px; color: #aaa;">{{ \Carbon\Carbon::parse($keg->event_date)->format('d M Y') }}</p>
                                        </div>
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- KEGIATAN TERBARU SECTION -->
    @if($latestArticles->count() > 0)
    @php
        $artikelFormatted = $latestArticles->map(function($art) {
            return [
                'title' => strtoupper($art->title),
                'excerpt' => \Illuminate\Support\Str::words(strip_tags($art->content), 20, '...'),
                'slug' => $art->slug,
                'cover' => $art->cover_image ? Storage::url($art->cover_image) : asset('img/kegiatan_bg2_1776780785146.png')
            ];
        });
    @endphp
    <section class="kegiatan-section" id="home-artikel-section" 
             style="background-image: url('{{ $latestArticles[0]->cover_image ? Storage::url($latestArticles[0]->cover_image) : asset('img/kegiatan_bg2_1776780785146.png') }}'); transition: background-image 0.5s ease-in-out;"
             data-artikels='@json($artikelFormatted)'>
        <div class="kegiatan-overlay"></div>
        <div class="kegiatan-content">
            <div class="kegiatan-box">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <span class="section-subtitle" style="margin-bottom: 0;">ARTIKEL TERBARU</span>
                    <a href="/artikel" style="font-size: 0.7rem; padding: 3px 10px; color: #d12e2e; border: 1px solid #d12e2e; border-radius: 4px; text-decoration: none; font-weight: bold; transition: background 0.3s;" onmouseover="this.style.background='#d12e2e'; this.style.color='white';" onmouseout="this.style.background='transparent'; this.style.color='#d12e2e';">LIHAT DAFTAR<br>ARTIKEL</a>
                </div>
                <h2 class="section-title" id="home-artikel-title" style="font-size: 1.6rem;">{{ strtoupper($latestArticles[0]->title) }}</h2>
                <p id="home-artikel-excerpt">{{ \Illuminate\Support\Str::words(strip_tags($latestArticles[0]->content), 20, '...') }}</p>
                <div style="margin-top: 15px;">
                    <a href="/artikel/{{ $latestArticles[0]->slug }}" id="home-artikel-link" class="btn btn-red">BACA ARTIKEL</a>
                </div>
                
                @if($latestArticles->count() > 1)
                <!-- Slider Controls at bottom right -->
                <div class="slider-controls">
                    <button class="slider-btn" onclick="prevArtikel()"><i class="fas fa-chevron-left"></i></button>
                    <button class="slider-btn" onclick="nextArtikel()"><i class="fas fa-chevron-right"></i></button>
                </div>
                @endif
            </div>
        </div>
    </section>

    @else
    <section class="kegiatan-section" style="background-image: url('{{ asset('img/kegiatan_bg2_1776780785146.png') }}');">
        <div class="kegiatan-overlay"></div>
        <div class="kegiatan-content">
            <div class="kegiatan-box">
                <span class="section-subtitle">KEGIATAN TERBARU</span>
                <h2 class="section-title" style="font-size: 1.6rem;">BELUM ADA ARTIKEL</h2>
                <p>Nantikan pengumuman dan berita kegiatan terbaru dari Dojo Al-Hanif.</p>
            </div>
        </div>
    </section>
    @endif

    <!-- FOOTER -->
    @include('partials.footer')

    <!-- MODAL LOGIN RAHASIA -->
    <div id="loginModal" class="modal-overlay" data-show="{{ session('error') ? 'true' : 'false' }}">
        <div class="modal-box">
            <span class="close-btn" onclick="tutupModal()" style="float: right; cursor: pointer; color: #666; font-size: 20px;">&times;</span>
            <h2 style="font-family: 'Montserrat', sans-serif;">Masuk Ruang Admin</h2>
            @if(session('error'))
                <p style="color: red; font-size: 13px; text-align: center; margin-bottom: 15px;">{{ session('error') }}</p>
            @endif
            <form action="/pintu-rahasia" method="POST">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-red" style="width: 100%; margin-top: 10px;">Masuk</button>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/beranda/popup.js') }}"></script>
    <script src="{{ asset('js/beranda/artikel_slider.js') }}"></script>
    <script src="{{ asset('js/beranda/agenda.js') }}"></script>
</body>
</html>