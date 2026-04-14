<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOJO AL-HANIF - Beranda</title>
    <link rel="stylesheet" href="{{ asset('css/beranda/popup.css') }}">
</head>

<body>

    <div style="text-align: center; margin-top: 100px;">
        <h1>Selamat Datang di DOJO AL-HANIF</h1>
        <br>
        <a href="/daftar" style="color: red; font-weight: bold;">Halaman Pendaftaran Publik</a>
    </div>

    <div id="loginModal" class="modal-overlay">
        <div class="modal-box">
            <span class="close-btn" onclick="tutupModal()">&times;</span>
            <h2>Masuk Ruang Admin</h2>
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
                <button type="submit" class="btn-submit">Login</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/beranda/popup.js') }}"></script>
</body>

</html>