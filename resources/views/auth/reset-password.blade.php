<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        * {
            box-sizing: border-box;
        }
    </style>
</head>
<body style="background:#f5f7fa;">

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
<div class="login-container" style="display:flex; justify-content:center; align-items:center; min-height:80vh;">

    <div style="
        max-width: 480px;
        width: 100%;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        padding: 40px;
    ">

        <!-- TITLE -->
        <div style="margin-bottom:25px;">
            <h2 style="color:#1e6fd9; margin-bottom:6px;">Reset Password</h2>
            <p style="color:#666; font-size:14px;">
                Masukkan data untuk membuat password baru
            </p>
        </div>

        <!-- ERROR -->
        @if ($errors->any())
            <div style="
                background:#fdecea;
                color:#c0392b;
                padding:12px;
                border-radius:10px;
                margin-bottom:20px;
                font-size:14px;
            ">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- TOKEN -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- EMAIL -->
            <div style="margin-bottom:18px;">
                <label style="display:block; margin-bottom:6px; font-weight:500;">Email</label>
                <input 
                    type="email" 
                    name="email"
                    value="{{ old('email', $request->email) }}"
                    readonly
                    style="
                        width:100%;
                        padding:12px 14px;
                        border-radius:10px;
                        border:1px solid #ddd;
                        background:#f1f1f1;
                    "
                >
            </div>

            <!-- PASSWORD -->
            <div style="margin-bottom:18px;">
                <label style="display:block; margin-bottom:6px; font-weight:500;">Password Baru</label>
                <input 
                    type="password" 
                    name="password"
                    placeholder="Masukkan password baru"
                    required
                    style="
                        width:100%;
                        padding:12px 14px;
                        border-radius:10px;
                        border:1px solid #ddd;
                        outline:none;
                    "
                    onfocus="this.style.border='1px solid #1e6fd9'"
                    onblur="this.style.border='1px solid #ddd'"
                >
            </div>

            <!-- CONFIRM PASSWORD -->
            <div style="margin-bottom:22px;">
                <label style="display:block; margin-bottom:6px; font-weight:500;">Konfirmasi Password</label>
                <input 
                    type="password" 
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    required
                    style="
                        width:100%;
                        padding:12px 14px;
                        border-radius:10px;
                        border:1px solid #ddd;
                        outline:none;
                    "
                    onfocus="this.style.border='1px solid #1e6fd9'"
                    onblur="this.style.border='1px solid #ddd'"
                >
            </div>

            <!-- BUTTON -->
            <button type="submit" style="
                width:100%;
                padding:12px;
                border-radius:10px;
                font-weight:600;
                font-size:15px;
                background:#1e6fd9;
                border:none;
                color:white;
                cursor:pointer;
                transition:0.3s;
            "
            onmouseover="this.style.background='#155ab6'"
            onmouseout="this.style.background='#1e6fd9'"
            >
                Reset Password
            </button>

        </form>

    </div>
</div>

</body>
</html>