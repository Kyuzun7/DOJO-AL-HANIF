<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin - DOJO AL-HANIF</title>

  <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>

<body>

  <div class="admin-container">
    <div class="header-admin">
      <div>
        <h1>Dashboard Admin</h1>
        <p>Halo, <strong>{{ Auth::user()->name }}</strong>
          <span class="user-tier">({{ strtoupper(str_replace('_', ' ', Auth::user()->role)) }})</span>
        </p>
      </div>
      <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="btn-logout">Keluar Sistem</button>
      </form>
    </div>

    @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-section">
      <h3 style="color: #e67e22;">🟠 Calon Anggota Baru ({{ $calon->count() }})</h3>
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>Nama</th>
              <th>WhatsApp</th>
              <th>Umur</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($calon as $c)
              <tr>
                <td><strong>{{ $c->nama_lengkap }}</strong></td>
                <td>{{ $c->no_whatsapp }}</td>
                <td>{{ $c->umur }} Thn</td>
                <td>
                  <div class="action-group">
                    <a href="https://wa.me/{{ $c->no_whatsapp }}" target="_blank" class="btn-wa">WA</a>
                    <form action="/admin/member/{{ $c->id }}/terima" method="POST">
                      @csrf
                      <button type="submit" class="btn-terima">Terima</button>
                    </form>
                    <form action="/admin/member/{{ $c->id }}/hapus" method="POST"
                      onsubmit="return confirm('Hapus pendaftaran?')">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn-hapus">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center">Tidak ada calon baru.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <hr style="margin: 40px 0; border: 1px solid #eee;">

    <div class="table-section">
      <h3 style="color: #27ae60;">🟢 Anggota Resmi ({{ $aktif->count() }})</h3>
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>Nama Lengkap</th>
              <th>WhatsApp</th>
              <th>Sabuk</th>
              <th>Tgl Diterima</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($aktif as $a)
              <tr>
                <td><strong>{{ $a->nama_lengkap }}</strong></td>
                <td>{{ $a->no_whatsapp }}</td>
                <td><span class="badge badge-aktif">{{ $a->sabuk ?? 'Putih' }}</span></td>
                <td>{{ $a->tanggal_diterima->format('d/m/Y') }}</td>
                <td>
                  <div class="action-group">
                    <a href="https://wa.me/{{ $a->no_whatsapp }}" target="_blank" class="btn-wa">Chat</a>
                    <form action="/admin/member/{{ $a->id }}/hapus" method="POST"
                      onsubmit="return confirm('Hapus anggota?')">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn-hapus">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center">Belum ada anggota resmi.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>

</html>