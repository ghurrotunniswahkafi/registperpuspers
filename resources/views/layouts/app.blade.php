<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="page">
            <div class="topbar">
                <div class="navbar-brand">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" class="navbar-logo">
                    <div class="navbar-text">
                        <span class="navbar-title">PERPUSTAKAAN</span>
                        <span class="navbar-subtitle">MONUMEN PERS NASIONAL</span>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: inline-block; margin: 0;">
                    @csrf
                    <button type="submit" class="logout-link" style="background: none; border: none; cursor: pointer; padding: 10px 60px; font-size: inherit; color: inherit; font-weight: inherit;">
                        LOGOUT
                    </button>
                </form>
            </div>

            <div class="container">

                <!-- SIDEBAR -->
                <div class="sidebar">
                    <div class="profile">
                        <div>👤</div>
                        <div>{{ auth()->user()->name ?? 'PENGGUNA' }}</div>
                    </div>

                    <div class="menu">
                        <a href="{{ route('form') }}" class="{{ request()->routeIs('form') ? 'active' : '' }}">PENGISIAN FORMULIR</a>
                        <a href="{{ route('status') }}" class="{{ request()->routeIs('status') ? 'active' : '' }}">STATUS PENGAJUAN</a>
                        <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">PROFIL DIRI</a>
                    </div>
                </div>

                <!-- MAIN -->
                <div class="main">
                    @yield('content')
                </div>

            </div>
        </div>
    </body>
</html>