<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Kendali Utama - DOJO AL-HANIF</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <style>
        .hub-container {
            max-width: 800px;
            margin: 100px auto;
            text-align: center;
        }
        .hub-title {
            font-family: 'Montserrat', sans-serif;
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 50px;
        }
        .hub-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 0 20px;
        }
        .hub-card {
            background: #fff;
            padding: 40px 20px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            text-decoration: none;
            color: #333;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .hub-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        .hub-icon {
            font-size: 4rem;
            color: #c0392b;
            margin-bottom: 20px;
        }
        .hub-icon.blue {
            color: #2980b9;
        }
        .hub-card-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            margin: 0 0 10px 0;
        }
        .hub-card-desc {
            font-family: 'Nunito', sans-serif;
            color: #7f8c8d;
            font-size: 1rem;
        }
        .logout-btn-container {
            margin-top: 60px;
        }
    </style>
</head>
<body style="background-color: #f5f6fa;">
    <div class="hub-container">
        <h1 class="hub-title">Pusat Kendali DOJO AL-HANIF</h1>
        
        <div class="hub-grid">
            <a href="/admin/anggota" class="hub-card">
                <i class="fas fa-users hub-icon blue"></i>
                <h2 class="hub-card-title">Dashboard Anggota</h2>
                <p class="hub-card-desc">Kelola calon anggota, data anggota aktif, dan prestasi.</p>
            </a>
            
            <a href="/admin/artikel" class="hub-card">
                <i class="fas fa-newspaper hub-icon"></i>
                <h2 class="hub-card-title">Dashboard Artikel</h2>
                <p class="hub-card-desc">Kelola data kegiatan, pengumuman, dan press release.</p>
            </a>
        </div>

        <div class="logout-btn-container">
            <a href="/" class="btn bg-blue" style="padding: 10px 30px; font-size: 1.1rem; border-radius: 30px; text-decoration: none; display: inline-block;">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
