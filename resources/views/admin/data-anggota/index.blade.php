<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Anggota</title>
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
            <h1>DATA ANGGOTA</h1>
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

        <section class="verify-card member-list-card">
            <div class="table-head">
                <h2>Daftar anggota perpustakaan</h2>
         
            </div>

            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Keanggotaan</th>
                    <th>Nama Anggota</th>
                    <th>Jenis Keanggotaan</th>
                    <th>Tindakan</th>
                </tr>
                </thead>
                <tbody>
                @forelse($members as $member)
                    <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ $member->nomor_keanggotaan ?? str_pad($member->id, 4, '0', STR_PAD_LEFT) . 'MPN' . $member->created_at->format('Y') }}</td>
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
                        <td>{{ $member->jenis_keanggotaan ?? 'Umum' }}</td>
                        <td class="action-cell">

                            <!-- EDIT -->
                            <a href="{{ route('admin.data-anggota.show', $member->id) }}" class="action-btn edit">
                                <img src="{{ asset('image/icons/icon-edit.png') }}">
                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('admin.data-anggota.destroy', $member->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="action-btn delete" onclick="return confirm('Yakin hapus?')">
                                    <img src="{{ asset('image/icons/icon-delete.png') }}">
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada data anggota.</td>
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
