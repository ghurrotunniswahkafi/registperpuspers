<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - Perpustakaan Monumen Pers Nasional</title>
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

    <!-- Register Container -->
    <div class="login-container">
        <div class="login-wrapper">
            <!-- Info Side -->
            <div class="login-info">
                <h3>BERGABUNGLAH DENGAN KAMI</h3>
                <h2>Member Perpustakaan</h2>

                <div class="info-section">
                    <h4>Proses Pendaftaran:</h4>
                    <ol class="process-list">
                        <li>
                            
                            <span>Buat akun (jika belum pernah membuat), login jika sudah mempunyai akun</span>
                        </li>
                        <li>
                            
                            <span>Isi formulir pendaftaran keanggotaan secara lengkap</span>
                        </li>
                        <li>
                            <span>Tunggu proses validasi data oleh petugas perpustakaan</span>
                        </li>
                        <li>
                            <span>Jika pendaftaran telah divalidasi:</span>
                            <ul class="sub-steps">
                                <li><i class="fas fa-download"></i> Unduh berkas pendaftaran yang tersedia di akun Anda</li>
                                <li><i class="fas fa-print"></i> Cetak berkas tersebut, lalu datang ke perpustakaan</li>
                                <li><i class="fas fa-id-card"></i> Bawa berkas yang sudah dicetak beserta KTP (asli atau fotokopi)</li>
                            </ul>
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
                .step-icon {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 32px;
                    height: 32px;
                    background: #c7a17a;
                    border-radius: 50%;
                    margin-right: 12px;
                    flex-shrink: 0;
                    color: #fff;
                    font-size: 14px;
                }
                .sub-steps {
                    list-style: none;
                    padding-left: 44px;
                    margin-top: 10px;
                }
                .sub-steps li {
                    padding: 6px 0;
                    font-size: 13px;
                    opacity: 0.9;
                }
                .sub-steps li i {
                    width: 18px;
                    color: #c7a17a;
                    margin-right: 8px;
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
                        <strong>Pendaftaran Gagal!</strong>
                        <ul style="margin-top: 8px; margin-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-header">
                    <h2>Daftar Sekarang</h2>
                    <p>Buat akun baru Anda untuk mengakses perpustakaan</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap Anda">
                        @if ($errors->has('name'))
                            <span class="form-error">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="you@example.com">
                        @if ($errors->has('email'))
                            <span class="form-error">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <input type="password" id="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter">
                        @if ($errors->has('password'))
                            <span class="form-error">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi Anda">
                        @if ($errors->has('password_confirmation'))
                            <span class="form-error">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="btn-login">Daftar</button>
                </form>

                <!-- Divider -->
                <div class="divider">atau</div>

                <!-- Login Link -->
                <div class="form-register">
                    Sudah memiliki akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-error {
            display: block;
            color: #c33;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</body>
</html>
