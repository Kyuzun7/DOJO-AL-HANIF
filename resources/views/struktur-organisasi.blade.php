<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi - DOJO AL-HANIF</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/beranda/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/beranda/struktur.css') }}">
</head>
<body>

    @include('partials.navbar')

    <div class="structure-container">
        <h1 class="header-title">STRUKTUR ORGANISASI</h1>
        <p class="header-subtitle">Susunan pengurus DOJO AL-HANIF periode saat ini yang berdedikasi tinggi dalam pengembangan karakter dan prestasi bela diri.</p>

        <div class="tree" id="orgTree">
            <!-- Level 1: Ketua -->
            <div class="tree-row">
                <div class="member-card" onclick="openBio('ketua')">
                    <i class="fas fa-user-tie member-icon"></i>
                    <div class="member-role">KETUA</div>
                    <div class="member-name">{{ isset($pengurus['ketua']) ? $pengurus['ketua']->pluck('nama_lengkap')->implode(', ') : '-' }}</div>
                </div>
            </div>

            <!-- Level 2: Bendahara & Sekretaris -->
            <div class="tree-row">
                <div style="position: relative;">
                    <div class="vertical-line"></div>
                    <div class="member-card" onclick="openBio('bendahara')">
                        <i class="fas fa-wallet member-icon"></i>
                        <div class="member-role">BENDAHARA</div>
                        <div class="member-name">{{ isset($pengurus['bendahara']) ? $pengurus['bendahara']->pluck('nama_lengkap')->implode(', ') : '-' }}</div>
                    </div>
                </div>
                <div style="position: relative;">
                    <div class="vertical-line"></div>
                    <div class="member-card" onclick="openBio('sekretaris')">
                        <i class="fas fa-file-signature member-icon"></i>
                        <div class="member-role">SEKRETARIS</div>
                        <div class="member-name">{{ isset($pengurus['sekretaris']) ? $pengurus['sekretaris']->pluck('nama_lengkap')->implode(', ') : '-' }}</div>
                    </div>
                </div>
            </div>

            <!-- Level 3: Bidang-Bidang -->
            <div class="tree-row">
                <div style="position: relative;">
                    <div class="vertical-line"></div>
                    <div class="member-card" onclick="openBio('ukt_gasuku')">
                        <i class="fas fa-fist-raised member-icon"></i>
                        <div class="member-role">UKT & GASUKU</div>
                        <div class="member-name">{{ isset($pengurus['ukt_gasuku']) ? $pengurus['ukt_gasuku']->pluck('nama_lengkap')->implode(', ') : '-' }}</div>
                    </div>
                </div>
                <div style="position: relative;">
                    <div class="vertical-line"></div>
                    <div class="member-card" onclick="openBio('bimbingan_prestasi')">
                        <i class="fas fa-trophy member-icon"></i>
                        <div class="member-role">BIMBINGAN PRESTASI</div>
                        <div class="member-name">{{ isset($pengurus['bimbingan_prestasi']) ? $pengurus['bimbingan_prestasi']->pluck('nama_lengkap')->implode(', ') : '-' }}</div>
                    </div>
                </div>
                <div style="position: relative;">
                    <div class="vertical-line"></div>
                    <div class="member-card" onclick="openBio('bidang_usaha')">
                        <i class="fas fa-briefcase member-icon"></i>
                        <div class="member-role">BIDANG USAHA</div>
                        <div class="member-name">{{ isset($pengurus['bidang_usaha']) ? $pengurus['bidang_usaha']->pluck('nama_lengkap')->implode(', ') : '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Pengurus -->
    <div class="modal-overlay" id="detailModal">
        <div class="modal-card">
            <div class="modal-header">
                <span class="modal-close" onclick="closeDetail()">&times;</span>
                <i class="fas fa-user-circle" id="modalIcon" style="font-size: 5rem; display: none;"></i>
                <img id="modalFoto" src="" alt="Foto Pengurus" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 3px solid white; display: none; margin: 0 auto;">
            </div>
            <div class="modal-body">
                <h3 id="modalName">-</h3>
                <p class="role"><span id="modalRoleText">-</span> <span id="modalSubJabatan" style="font-size: 0.9em; font-weight: normal; margin-left: 5px;"></span></p>
                
                <div class="detail-item">
                    <span class="detail-label">Tingkatan / Sabuk</span>
                    <span class="detail-value" id="modalBelt">-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Periode Jabatan</span>
                    <span class="detail-value" id="modalPeriod">-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Prestasi Lomba</span>
                    <span class="detail-value" id="modalLomba">-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Sertifikasi & Lisensi</span>
                    <span class="detail-value" id="modalSertif">-</span>
                </div>

                <div class="modal-slider-controls" id="modalSliderControls" style="display:flex; justify-content:space-between; margin-top: 20px;">
                    <button class="btn btn-red btn-sm" onclick="prevBio()" style="padding: 5px 15px;">&laquo; Sebelumnya</button>
                    <button class="btn btn-red btn-sm" onclick="nextBio()" style="padding: 5px 15px;">Selanjutnya &raquo;</button>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <script>
        // Data dari Laravel Backend
        const biodataGroup = @json($pengurus);
    </script>
    <script src="{{ asset('js/beranda/struktur.js') }}?v={{ time() }}"></script>
</body>
</html>
