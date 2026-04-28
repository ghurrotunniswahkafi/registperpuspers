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
                <div style="display: flex; align-items: center; gap: 15px; flex: 1;">
                    <button id="sidebar-toggle" class="sidebar-toggle" style="display: none; background: none; border: none; color: #333; cursor: pointer; font-size: 24px;">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="navbar-brand">
                        <img src="{{ asset('image/logo.png') }}" alt="Logo" class="navbar-logo">
                        <div class="navbar-text">
                            <span class="navbar-title">PERPUSTAKAAN</span>
                            <span class="navbar-subtitle">MONUMEN PERS NASIONAL</span>
                        </div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 10px; padding: 0 15px;">
                    <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: inline-block; margin: 0;">
                        @csrf
                        <button type="submit" class="logout-btn" style="background-color: ##004391; border: none; cursor: pointer; padding: 10px 20px; font-size: 14px; color: #ffffff; font-weight: 600; border-radius: 5px; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#004391'" onmouseout="this.style.backgroundColor='#2a15c7'">
                            <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i> LOGOUT
                        </button>
                    </form>
                </div>
            </div>

            <!-- SIDEBAR OVERLAY -->
            <div id="sidebar-overlay" class="sidebar-overlay" style="display: none;"></div>

            <div class="container">

                <!-- SIDEBAR -->
                <div class="sidebar" id="sidebar">
                    <div class="profile" style="display: flex; align-items: center; gap: 10px;">
                        <img src="{{ asset('image/Profile.png') }}" alt="Profile" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 1px solid rgba(0,0,0,0.1);">
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

        <script>
            // Sidebar Toggle Functionality
            document.addEventListener('DOMContentLoaded', function() {
                const sidebarToggle = document.getElementById('sidebar-toggle');
                const sidebar = document.getElementById('sidebar');
                const sidebarOverlay = document.getElementById('sidebar-overlay');

                // Show toggle button on mobile
                function updateToggleButtonVisibility() {
                    if (window.innerWidth <= 768) {
                        sidebarToggle.style.display = 'block';
                    } else {
                        sidebarToggle.style.display = 'none';
                        sidebar.classList.remove('active');
                        sidebarOverlay.style.display = 'none';
                    }
                }

                // Initial check
                updateToggleButtonVisibility();

                // Toggle sidebar on button click
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    if (sidebar.classList.contains('active')) {
                        sidebarOverlay.style.display = 'block';
                    } else {
                        sidebarOverlay.style.display = 'none';
                    }
                });

                // Close sidebar when overlay is clicked
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    sidebarOverlay.style.display = 'none';
                });

                // Close sidebar when a menu item is clicked
                const menuLinks = sidebar.querySelectorAll('.menu a');
                menuLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        sidebar.classList.remove('active');
                        sidebarOverlay.style.display = 'none';
                    });
                });

                // Update on window resize
                window.addEventListener('resize', updateToggleButtonVisibility);
            });
        </script>
    </body>
</html>