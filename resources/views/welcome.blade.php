<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang - Perpustakaan Monumen Pers Nasional</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .welcome-container {
            min-height: calc(100vh - 90px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 20px;
            background: #f5f6f8;
        }

        .welcome-wrapper {
            display: grid;
            grid-template-columns: minmax(320px, 1.08fr) minmax(320px, 0.92fr);
            width: min(100%, 1040px);
            overflow: hidden;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .welcome-image {
            min-height: 640px;
            background: #173f99;
        }

        .welcome-image img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top center;
        }

        .welcome-actions {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 56px 48px;
        }

        .welcome-eyebrow {
            margin: 0 0 10px;
            color: #0066cc;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .welcome-actions h1 {
            margin: 0 0 14px;
            color: #1f2937;
            font-size: 32px;
            font-weight: 700;
            line-height: 1.25;
        }

        .welcome-description {
            margin: 0 0 32px;
            color: #666666;
            font-size: 14px;
            line-height: 1.7;
        }

        .welcome-buttons {
            display: grid;
            gap: 14px;
        }

        .welcome-button {
            min-height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 20px;
            border: 1px solid #0066cc;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
        }

        .welcome-button:hover {
            transform: translateY(-1px);
        }

        .welcome-button-primary {
            background: #0066cc;
            color: #ffffff;
        }

        .welcome-button-primary:hover {
            background: #0052a3;
            color: #ffffff;
        }

        .welcome-button-secondary {
            background: #ffffff;
            color: #0066cc;
        }

        .welcome-button-secondary:hover {
            background: #eef6ff;
            color: #0052a3;
        }

        .welcome-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 28px 0 0;
            padding: 16px;
            border-radius: 8px;
            background: #eef6ff;
            color: #4b5563;
            font-size: 13px;
            line-height: 1.6;
        }

        .welcome-note i {
            margin-top: 3px;
            color: #0066cc;
        }

        @media (max-width: 800px) {
            .welcome-wrapper {
                grid-template-columns: 1fr;
                max-width: 620px;
            }

            .welcome-image {
                min-height: auto;
                max-height: none;
            }

            .welcome-image img {
                height: auto;
                object-fit: contain;
            }

            .welcome-actions {
                padding: 36px 28px;
            }
        }

        @media (max-width: 480px) {
            .welcome-container {
                padding: 16px 12px;
            }

            .welcome-wrapper {
                border-radius: 10px;
            }

            .welcome-actions {
                padding: 30px 20px;
            }

            .welcome-actions h1 {
                font-size: 25px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <img src="{{ asset('image/logo.png') }}" alt="Logo Perpustakaan Monumen Pers Nasional" class="header-logo">
            <div class="header-text">
                <h1>PERPUSTAKAAN</h1>
                <p>MONUMEN PERS NASIONAL</p>
            </div>
        </div>
    </header>

    <main class="welcome-container">
        <section class="welcome-wrapper">
            <div class="welcome-image">
                <img src="{{ asset('image/alur-pendaftaran.png') }}" alt="Alur pendaftaran keanggotaan perpustakaan">
            </div>

            <div class="welcome-actions">
                <p class="welcome-eyebrow">Keanggotaan Perpustakaan</p>
                <h1>Selamat Datang</h1>
                <p class="welcome-description">
                    Silakan masuk jika sudah memiliki akun, atau daftar terlebih dahulu untuk memulai proses pendaftaran anggota perpustakaan.
                </p>

                <div class="welcome-buttons">
                    @auth
                        <a href="{{ route('dashboard') }}" class="welcome-button welcome-button-primary">
                            <i class="fas fa-gauge-high"></i>
                            Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="welcome-button welcome-button-primary">
                            <i class="fas fa-right-to-bracket"></i>
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="welcome-button welcome-button-secondary">
                            <i class="fas fa-user-plus"></i>
                            Register
                        </a>
                    @endauth
                </div>

                <p class="welcome-note">
                    <i class="fas fa-circle-info"></i>
                    <span>Pendaftaran anggota gratis dan dapat dilakukan oleh semua kalangan.</span>
                </p>
            </div>
        </section>
    </main>
</body>
</html>
