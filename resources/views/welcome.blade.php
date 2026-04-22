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
</head>
<body>

    <!-- NAVBAR -->
    @include('partials.navbar')

    <!-- HERO SECTION -->
    <section class="hero-section" style="background-image: url('{{ asset('img/hero_bg_1776780702375.png') }}');">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">
                Selamat Datang<br>
                Di <span class="text-accent">DOJO AL-<br>HANIF</span>
            </h1>
            <p class="hero-subtitle">
                Membangun karakter melalui kedisiplinan Bushido. Kami melatih tubuh dan jiwa untuk mencapai harmoni sempurna antara kekuatan dan kerendahan hati.
            </p>
            <div class="hero-buttons">
                @auth
                    <a href="/dashboard" class="btn btn-white">MASUK DASHBOARD</a>
                    <form action="/logout" method="POST" style="display: inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-outline-red">KELUAR AKUN</button>
                    </form>
                @else
                    <a href="/daftar" class="btn btn-white">JOIN NOW</a>
                    <a href="#sejarah" class="btn btn-outline-red">PELAJARI LEBIH</a>
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
                <span class="section-subtitle">THE LEGACY</span>
                <h2 class="section-title" style="margin-bottom: 20px;">SEJARAH</h2>
                <p>
                    Dojo Al-Hanif didirikan dengan semangat untuk melestarikan nilai-nilai murni bela diri tradisional di tengah gempuran modernisasi. Berawal dari sekelompok kecil praktisi yang mencari kedalaman spiritual dalam teknik, kini kami berkembang menjadi pusat unggulan pengembangan karakter.
                </p>
                <p>
                    Selama bertahun-tahun, Al-Hanif telah mencetak atlet-atlet berprestasi dan individu yang tangguh di masyarakat, memegang teguh prinsip kejujuran, keberanian, dan rasa hormat yang menjadi fondasi setiap gerakan kami.
                </p>
            </div>
            <div class="sejarah-image">
                <img src="{{ asset('img/sejarah_img_1776780723639.png') }}" alt="Sejarah Dojo Al-Hanif">
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
                    <p>Menjadi dojo rujukan utama dalam pembentukan generasi yang mandiri, berkarakter bushido, dan unggul dalam prestasi nasional maupun internasional.</p>
                </div>
                <div class="misi-wrapper">
                    <h3>MISI</h3>
                    <div class="misi-grid">
                        <div class="misi-item">
                            <span class="misi-num">01</span>
                            <p>Menyelenggarakan latihan teknis karate yang disiplin dan sistematis.</p>
                        </div>
                        <div class="misi-item">
                            <span class="misi-num">02</span>
                            <p>Menanamkan nilai kejujuran (Gi) dalam setiap interaksi.</p>
                        </div>
                        <div class="misi-item">
                            <span class="misi-num">03</span>
                            <p>Membangun keberanian (Yu) untuk menghadapi tantangan hidup.</p>
                        </div>
                        <div class="misi-item">
                            <span class="misi-num">04</span>
                            <p>Mengajarkan kebajikan (Jin) dan kasih sayang antar sesama.</p>
                        </div>
                        <div class="misi-item">
                            <span class="misi-num">05</span>
                            <p>Menjunjung tinggi kesopanan (Rei) dalam etiket dojo.</p>
                        </div>
                        <div class="misi-item">
                            <span class="misi-num">06</span>
                            <p>Melatih ketulusan (Makoto) dalam perkataan dan perbuatan.</p>
                        </div>
                         <div class="misi-item">
                            <span class="misi-num">07</span>
                            <p>Menjaga kehormatan (Meiyo) institusi dan diri sendiri.</p>
                        </div>
                         <div class="misi-item">
                            <span class="misi-num">08</span>
                            <p>Menumbuhkan loyalitas (Chugi) kepada guru dan rekan sejawat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TUJUAN & BENEFIT SECTION -->
    <section class="section-padding tujuan-benefit-wrapper">
        <div class="container">
            <hr class="tujuan-divider">
            <div class="tujuan-section">
                <h2 class="section-title" style="margin-bottom: 20px;">TUJUAN</h2>
                <p class="tujuan-text">
                    Tujuan utama kami adalah menciptakan lingkungan yang mendukung transformasi fisik dan mental. Kami ingin setiap anggota Dojo Al-Hanif tidak hanya menjadi petarung yang handal di matras, tetapi juga menjadi pemimpin yang bijaksana dalam kehidupan sehari-hari, mampu mengaplikasikan filosofi bela diri untuk kebaikan masyarakat luas.
                </p>
            </div>

            <div class="benefit-section">
                <h2 class="section-title">BENEFIT</h2>
                <div class="benefit-grid">
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-star"></i></div>
                        <h3>HOBI</h3>
                        <p>Salurkan minat Anda dalam lingkungan yang positif. Karate bukan sekadar olahraga, melainkan gaya hidup yang penuh dengan eksplorasi teknik dan budaya.</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-bullseye"></i></div>
                        <h3>KOMPETENSI</h3>
                        <p>Asah kemampuan bela diri Anda di bawah bimbingan sensei berpengalaman. Kami menyiapkan kurikulum atlet untuk jenjang kompetisi prestasi.</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-shield-alt"></i></div>
                        <h3>KESEHATAN</h3>
                        <p>Tingkatkan stamina, fleksibilitas, dan kekuatan tubuh secara menyeluruh. Latihan rutin kami dirancang untuk kesehatan jantung dan manajemen stres.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- KEGIATAN TERBARU SECTION -->
    @if($latestArticles->count() > 0)
    <section class="kegiatan-section" id="home-artikel-section" style="background-image: url('{{ $latestArticles[0]->cover_image ? Storage::url($latestArticles[0]->cover_image) : asset('img/kegiatan_bg2_1776780785146.png') }}'); transition: background-image 0.5s ease-in-out;">
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

    @if($latestArticles->count() > 1)
    <script>
        const artikelData = [
            @foreach($latestArticles as $art)
            {
                title: @json(strtoupper($art->title)),
                excerpt: @json(\Illuminate\Support\Str::words(strip_tags($art->content), 20, '...')),
                slug: @json($art->slug),
                cover: @json($art->cover_image ? Storage::url($art->cover_image) : asset('img/kegiatan_bg2_1776780785146.png'))
            },
            @endforeach
        ];
        
        let currentArtikelIndex = 0;
        
        function updateArtikelDisplay() {
            const art = artikelData[currentArtikelIndex];
            document.getElementById('home-artikel-section').style.backgroundImage = `url('${art.cover}')`;
            
            // simple fade effect for text
            const titleEl = document.getElementById('home-artikel-title');
            const excerptEl = document.getElementById('home-artikel-excerpt');
            
            titleEl.style.opacity = 0;
            excerptEl.style.opacity = 0;
            
            setTimeout(() => {
                titleEl.innerText = art.title;
                excerptEl.innerText = art.excerpt;
                document.getElementById('home-artikel-link').href = `/artikel/${art.slug}`;
                titleEl.style.opacity = 1;
                excerptEl.style.opacity = 1;
            }, 300);
        }
        
        function nextArtikel() {
            currentArtikelIndex = (currentArtikelIndex + 1) % artikelData.length;
            updateArtikelDisplay();
        }
        
        function prevArtikel() {
            currentArtikelIndex = (currentArtikelIndex - 1 + artikelData.length) % artikelData.length;
            updateArtikelDisplay();
        }
    </script>
    @endif

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

    <!-- MODAL LOGIN RAHASIA -->
    <div id="loginModal" class="modal-overlay">
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
    <script>
        window.onload = function() {
            if ("{{ session('error') }}") {
                document.getElementById("loginModal").style.display = "flex";
            }
        };
    </script>
</body>
</html>