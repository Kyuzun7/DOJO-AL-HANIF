<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Press Release - DOJO AL-HANIF</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
            font-size: 16px;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container" style="max-width: 900px;">
        <h2>Edit Artikel</h2>
        <a href="/admin/artikel" class="link-back">&larr; Batal & Kembali</a>

        <div style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 20px;">
            <form action="/admin/artikel/{{ $pressRelease->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Judul Artikel</label>
                    <input type="text" name="title" class="form-input" required value="{{ old('title', $pressRelease->title) }}">
                </div>

                <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                    <div style="flex: 1;">
                        <label class="form-label">Tanggal Publikasi</label>
                        <input type="date" name="published_date" class="form-input" required value="{{ old('published_date', $pressRelease->published_date) }}">
                    </div>
                    <div style="flex: 1;">
                        <label class="form-label">Cover Image (Upload baru untuk mengganti)</label>
                        <input type="file" name="cover_image" class="form-input" accept="image/*">
                        @if($pressRelease->cover_image)
                            <div style="margin-top: 10px;">
                                <img src="{{ Storage::url($pressRelease->cover_image) }}" alt="Preview" style="max-height: 100px; border-radius: 5px;">
                                <small style="display:block; color:#777;">Gambar saat ini</small>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Isi Konten Artikel</label>
                    <textarea name="content" id="editor">{{ old('content', $pressRelease->content) }}</textarea>
                </div>

                <button type="submit" class="btn bg-blue" style="width:100%; padding:15px; font-size:16px;">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <!-- CKEditor 5 CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'undo', 'redo' ]
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
</body>
</html>
