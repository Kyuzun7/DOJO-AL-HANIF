<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Press Release - DOJO AL-HANIF</title>
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
        <h2>Tambah Artikel Baru</h2>
        <a href="/admin/artikel" class="link-back">&larr; Batal & Kembali</a>

        <div style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 20px;">
            <form action="/admin/artikel" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Judul Artikel</label>
                    <input type="text" name="title" class="form-input" required value="{{ old('title') }}" placeholder="Masukkan judul artikel...">
                </div>

                <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                    <div style="flex: 1;">
                        <label class="form-label">Tanggal Publikasi</label>
                        <input type="date" name="published_date" class="form-input" required value="{{ old('published_date', date('Y-m-d')) }}">
                    </div>
                    <div style="flex: 1;">
                        <label class="form-label">Cover Image Utama (Opsional)</label>
                        <input type="file" name="cover_image" class="form-input" accept="image/*">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Isi Konten Artikel</label>
                    <textarea name="content" id="editor">{{ old('content') }}</textarea>
                </div>

                <button type="submit" class="btn bg-green" style="width:100%; padding:15px; font-size:16px;">Publish Artikel</button>
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
