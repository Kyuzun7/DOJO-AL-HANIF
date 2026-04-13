<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran DOJO AL-HANIF</title>

  <link rel="stylesheet" href="{{ asset('css/pendaftaran/daftar.css') }}">
</head>

<body>

  <div class="form-card">
    <h2>Daftar DOJO AL-HANIF</h2>

    <form action="/daftar" method="POST">
      @csrf

      <div class="honeypot-field">
        <label>Jangan isi kolom ini jika Anda manusia:</label>
        <input type="text" name="url_website" tabindex="-1" autocomplete="off">
      </div>

      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Nomor WhatsApp</label>
        <input type="text" name="no_whatsapp" class="form-control" placeholder="Contoh: 08123456789" required>
      </div>

      <div class="form-group">
        <label>Umur</label>
        <input type="number" name="umur" class="form-control">
      </div>

      <div class="form-group">
        <label>Sabuk Saat Ini (Opsional)</label>
        <select name="sabuk" class="form-control">
          <option value="">Belum Punya Sabuk (Pemula)</option>
          <option value="Putih">Sabuk Putih</option>
          <option value="Kuning">Sabuk Kuning</option>
          <option value="Hijau">Sabuk Hijau</option>
        </select>
      </div>

      <button type="submit" class="btn-submit">
        Daftar Sekarang
      </button>
    </form>
  </div>

</body>

</html>