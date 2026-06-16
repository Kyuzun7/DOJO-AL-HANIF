<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin - DOJO AL-HANIF</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <style>
        .form-container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 600px; margin-top: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        .text-danger { color: red; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Profil Admin: {{ $admin->name }}</h2>
        <a href="/admin/profile" class="link-back">&larr; Kembali ke Profil Admin</a>

        @if(session('error'))
            <div class="alert-error" style="font-weight: bold; margin-bottom: 20px; color: red;">✗ {{ session('error') }}</div>
        @endif

        <div class="form-container">
            <form action="/admin/profile/{{ $admin->id }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-input" required value="{{ old('name', $admin->name) }}">
                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-input" required value="{{ old('username', $admin->username) }}">
                    @error('username')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Password Baru (Biarkan kosong jika tidak ingin mengubah)</label>
                    <div style="position: relative;">
                        <input type="password" name="password" id="passwordInput" class="form-input" style="padding-right: 40px;">
                        <i class="fas fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #666;"></i>
                    </div>
                    @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                @if(auth()->user()->role !== 'tier_2')
                    @if($admin->role === 'tier_0')
                        <div class="form-group">
                            <label class="form-label">Hak Akses (Role)</label>
                            <input type="text" class="form-input" value="TIER 0 (Super Admin - Sistem)" disabled>
                            <small style="color: #666; font-size: 11px;">Hak akses Tier 0 hanya dapat diubah melalui sistem database.</small>
                        </div>
                    @else
                        <div class="form-group">
                            <label class="form-label">Hak Akses (Role)</label>
                            <select name="role" class="form-input" required>
                                <option value="tier_1" {{ $admin->role === 'tier_1' ? 'selected' : '' }}>TIER 1 (Admin - Akses Normal)</option>
                                <option value="tier_2" {{ $admin->role === 'tier_2' ? 'selected' : '' }}>TIER 2 (Staff - Hanya Absensi & Profil Sendiri)</option>
                            </select>
                            @error('role')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    @endif
                @endif

                <button type="submit" class="btn bg-blue" style="width: 100%; padding: 12px; margin-top: 10px;">Perbarui Admin</button>
            </form>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#passwordInput');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
