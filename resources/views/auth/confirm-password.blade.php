<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<!-- HEADER -->
<div class="header">
    <div class="header-content">
        <img src="{{ asset('image/logo.png') }}" class="header-logo">
        <div class="header-text">
            <h1>PERPUSTAKAAN</h1>
            <p>MONUMEN PERS NASIONAL</p>
        </div>
    </div>
</div>

<!-- CONTAINER -->
<div class="login-container">
    <div class="login-form" style="max-width: 520px; width: 100%; margin: auto; background: white; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); padding: 40px;">

        <!-- TITLE -->
        <div class="form-header">
            <h2 style="color:#0066cc;">Lupa Password</h2>
            <p>Masukkan email untuk mendapatkan link reset password</p>
        </div>

        <!-- STATUS SUCCESS -->
        @if (session('status'))
            <div class="success-message" style="background:#d4edda; color:#155724; padding:10px; border-radius:8px; margin-bottom:15px;">
                {{ session('status') }}
            </div>
        @endif

        <!-- ERROR -->
        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first('email') }}
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input 
                    type="email" 
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email Anda"
                    required
                    autofocus
                >
            </div>

            <button type="submit" class="btn-login">
                Kirim Link Reset Password
            </button>
        </form>

    </div>
</div>

</body>
</html>