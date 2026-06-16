<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan - DOJO AL-HANIF</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/editor-form.css') }}">
</head>
<body>
    <div class="container" style="max-width: 900px;">
        <h2>Edit Kegiatan</h2>
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
            <form action="/admin/kegiatan/{{ $kegiatan->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Judul Kegiatan</label>
                    <input type="text" name="title" class="form-input" required value="{{ old('title', $kegiatan->title) }}">
                </div>

                <div style="display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 200px;">
                        <label class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" name="event_date" class="form-input" required value="{{ old('event_date', $kegiatan->event_date) }}">
                    </div>
                    <div style="flex: 1; min-width: 200px;">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="location" class="form-input" value="{{ old('location', $kegiatan->location) }}">
                    </div>
                    <div style="flex: 1; min-width: 250px;">
                        <label class="form-label">Gambar Sampul / Brosur (Unggah baru untuk mengganti)</label>
                        <input type="file" name="flyer_image" class="form-input" accept="image/*">
                        @if($kegiatan->flyer_image)
                            <div style="margin-top: 10px;">
                                <img src="{{ Storage::url($kegiatan->flyer_image) }}" alt="Preview" style="max-height: 100px; border-radius: 5px;">
                                <small style="display:block; color:#777;">Gambar saat ini</small>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi / Info Lengkap</label>
                    <textarea name="description" id="editor">{{ old('description', $kegiatan->description) }}</textarea>
                </div>

                <button type="submit" class="btn bg-blue" style="width:100%; padding:15px; font-size:16px;">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <!-- CKEditor 5 CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="{{ asset('js/admin/ckeditor-init.js') }}"></script>
</body>
</html>
