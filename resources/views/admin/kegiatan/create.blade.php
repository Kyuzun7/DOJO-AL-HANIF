<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan - DOJO AL-HANIF</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/editor-form.css') }}">
</head>
<body>
    <div class="container" style="max-width: 900px;">
        <h2>Tambah Kegiatan Baru</h2>
        <a href="/admin/kegiatan" class="link-back">&larr; Batal & Kembali</a>

        @if($errors->any())
            <div style="background: #ffeaea; color: #d32f2f; padding: 15px; border-radius: 5px; margin-top: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 20px;">
            <form action="/admin/kegiatan" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Judul Kegiatan</label>
                    <input type="text" name="title" class="form-input" required value="{{ old('title') }}" placeholder="Contoh: Gashuku Nasional 2026">
                </div>

                <div style="display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 200px;">
                        <label class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" name="event_date" class="form-input" required value="{{ old('event_date') }}">
                    </div>
                    <div style="flex: 1; min-width: 200px;">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="location" class="form-input" value="{{ old('location') }}" placeholder="Contoh: GOR Ragunan, Jakarta">
                    </div>
                    <div style="flex: 1; min-width: 250px;">
                        <label class="form-label">Gambar Sampul / Brosur (Opsional)</label>
                        <input type="file" name="flyer_image" class="form-input" accept="image/*">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi / Info Lengkap</label>
                    <textarea name="description" id="editor">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn bg-green" style="width:100%; padding:15px; font-size:16px;">+ Simpan Kegiatan</button>
            </form>
        </div>
    </div>

    <!-- CKEditor 5 CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="{{ asset('js/admin/ckeditor-init.js') }}"></script>
</body>
</html>
