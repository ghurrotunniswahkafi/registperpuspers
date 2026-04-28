<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Perpustakaan Monumen Pers Nasional</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="header-logo">
            <div class="header-text">
                <h1>PERPUSTAKAAN</h1>
                <p>MONUMEN PERS NASIONAL</p>
            </div>
        </div>
    </div>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-wrapper">
            <!-- Info Side -->
            <div class="login-info">
                <h3>SELAMAT DATANG</h3>
                <h2>Member Perpustakaan Monumen Pers Nasional</h2>
                
                <div class="info-section">
    <h4>Informasi:</h4>
    <ol class="process-list">
        <li>
            <span>Login menggunakan akun yang telah terdaftar</span>
        </li>
        <li>
            <span>Belum punya akun? Silakan daftar terlebih dahulu</span>
        </li>
    </ol>
</div>

<style>
.process-list {
    padding-left: 0;
    list-style: none;
    margin-top: 15px;
}
.process-list > li {
    display: flex;
    align-items: flex-start;
    margin-bottom: 12px;
    padding: 10px 12px;
    background: rgba(255,255,255,0.1);
    border-radius: 8px;
    transition: all 0.3s ease;
}
.process-list > li:hover {
    background: rgba(255,255,255,0.2);
    transform: translateX(5px);
}
</style>
                <div class="info-section">
                    <p><i class="fas fa-info-circle"></i> Gratis untuk semua kalangan. Tidak perlu biaya pendaftaran apapun.</p>
                </div>
               
            </div>

            <!-- Form Side -->
            <div class="login-form">
                @if ($errors->any())
                    <div class="error-message">
                        <strong>Login Gagal!</strong>
                        <ul style="margin-top: 8px; margin-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-header">
                    <h2>Selamat Datang!</h2>
                    <p>Silahkan Masuk dengan Akun Anda</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@email.com">
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi">
                    </div>

                    <!-- Forgot Password -->
                    <div class="form-forgot">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">lupa password?</a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn-login">Masuk</button>
                </form>

                <!-- Divider -->
                <div class="divider">atau</div>

              

                <!-- Register Link -->
                <div class="form-register">
                    Belum memiliki akun? <a href="{{ route('register') }}">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
