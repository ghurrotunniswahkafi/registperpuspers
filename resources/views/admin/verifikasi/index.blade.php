<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi</title>
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>
<body>

<div class="admin-wrapper">
    <aside class="sidebar">
        <div class="brand">
            <img src="{{ asset('image/logo.png') }}" alt="Logo">
            <div>
                <h3>PERPUSTAKAAN</h3>
                <p>MONUMEN PERS NASIONAL</p>
            </div>
        </div>

        <nav>
            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <img src="{{ asset('image/icons/icon-beranda.png') }}" class="nav-icon">
                Beranda
            </a>

            <a href="{{ route('admin.verifikasi') }}"
                class="{{ request()->routeIs('admin.verifikasi*') ? 'active' : '' }}">
                <img src="{{ asset('image/icons/icon-verifikasi.png') }}" class="nav-icon">
                Verifikasi
            </a>

            <a href="{{ route('admin.data-anggota') }}"
                class="{{ request()->routeIs('admin.data-anggota*') ? 'active' : '' }}">
                <img src="{{ asset('image/icons/icon-anggota.png') }}" class="nav-icon">
                Data Anggota
            </a>

            <a href="{{ route('admin.users') }}"
                class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <img src="{{ asset('image/icons/icon-admin.png') }}" class="nav-icon">
                User
            </a>

            <a href="{{ route('admin.laporan') }}"
                class="{{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                <img src="{{ asset('image/icons/icon-laporan.png') }}" class="nav-icon">
                Laporan
            </a>
        </nav>
    </aside>

    <main class="content">
        <header class="topbar">
            <h1>VERIFIKASI</h1>
            <div class="admin-menu" id="adminMenu">
                <button type="button" class="admin-toggle" onclick="toggleLogout()">
                    <img src="{{ asset('image/icons/Profile.png') }}" alt="Admin" class="admin-icon">
                    <span>Admin</span>
                    <span class="admin-arrow">▸</span>
                </button>

                <div id="logoutBox" class="logout-box">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <section class="verify-card verify-list-card">
            <div class="table-head">
                <h2>Daftar calon anggota yang perlu ditinjau</h2>
                
            </div>

            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal Daftar</th>
                    <th>Tindakan</th>
                </tr>
                </thead>
                <tbody>
                @forelse($members as $member)
                    <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ str_pad($member->id, 4, '0', STR_PAD_LEFT) }}MPN{{ $member->created_at->format('Y') }}</td>
                        <td>
                            <span class="avatar">
                                @if($member->foto)
                                    <img src="{{ asset('storage/' . $member->foto) }}" alt="{{ $member->nama }}">
                                @else
                                    {{ strtoupper(substr($member->nama, 0, 2)) }}
                                @endif
                            </span>
                            {{ $member->nama }}
                        </td>
                        <td>{{ $member->created_at->format('d/m/y') }}</td>
                        <td class="verify-actions">
                            <a class="view-btn" href="{{ route('admin.verifikasi.show', $member->id) }}">
                                Lihat
                            </a>

                            <form method="POST" action="{{ route('admin.verifikasi.setujui', $member->id) }}" class="inline-form">
                                @csrf
                                <button type="submit" class="approve-btn" title="Setujui calon anggota">
                                    <img src="{{ asset('image/icons/icon-verifikasi.png') }}" alt="Setujui">
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada data yang perlu ditinjau.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </section>
    </main>
</div>

<script>
function toggleLogout() {
    const menu = document.getElementById('adminMenu');
    const box = document.getElementById('logoutBox');

    menu.classList.toggle('open');
    box.classList.toggle('show');
}
</script>


</body>
</html>
