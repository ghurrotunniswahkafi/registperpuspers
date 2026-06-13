<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Anggota</title>
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
                    <span class="admin-arrow">&rsaquo;</span>
                </button>

                <div id="logoutBox" class="logout-box">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <section class="detail-card member-detail-card">
            <div class="detail-title">
                <a href="{{ route('admin.data-anggota') }}" aria-label="Kembali ke daftar anggota">&lsaquo;</a>
                <h2>{{ $member->nama }}</h2>
            </div>

            <form method="POST" action="{{ route('admin.data-anggota.update', $member->id) }}">
                @csrf

                <div class="member-photo">
                    @if($member->foto)
                        <img src="{{ asset('storage/' . $member->foto) }}">
                    @endif
                </div>

                <div class="form-grid member-form-grid">
                    <div class="field full">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ $member->nama }}" readonly>
                    </div>

                    <div class="field full">
                        <label>Nomor Keanggotaan</label>
                        <input type="text" name="nomor_keanggotaan" value="{{ $member->nomor_keanggotaan ?? str_pad($member->id, 4, '0', STR_PAD_LEFT) . 'MPN' . $member->created_at->format('Y') }}" readonly>
                    </div>

                    <div class="field full">
                        <label>Jenis Keanggotaan</label>
                        <input type="text" name="jenis_keanggotaan" value="{{ $member->jenis_keanggotaan ?? 'Umum' }}" readonly>
                    </div>

                    <div class="field">
                        <label>Tanggal Registrasi</label>
                        <input type="text" value="{{ $member->created_at->translatedFormat('j F Y') }}" readonly>
                    </div>

                    <div class="field field-with-link">
                        <label>Tanggal Berakhir <a href="#">Perpanjang</a></label>
                        <input type="text" value="{{ $member->created_at->copy()->addYears(4)->translatedFormat('j F Y') }}" readonly>
                    </div>

                    <div class="field">
                        <label>Tempat</label>
                        <input type="text" name="tempat" value="{{ $member->tempat }}" readonly>
                    </div>

                    <div class="field">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ optional($member->tanggal_lahir)->format('Y-m-d') }}" readonly>
                    </div>

                    <div class="field full">
                        <label>Alamat Rumah</label>
                        <input type="text" name="alamat" value="{{ $member->alamat }}" readonly>
                    </div>

                    <div class="field">
                        <label>No. Telepon / HP</label>
                        <input type="text" name="no_hp" value="{{ $member->no_hp }}" readonly>
                    </div>

                    <div class="field">
                        <label>Alamat Email</label>
                        <input type="email" name="email" value="{{ $member->email }}" readonly>
                    </div>

                    <div class="field">
                        <label>Media Sosial</label>
                        <input type="text" name="sosmed" value="{{ $member->sosmed }}" readonly>
                    </div>

                    <div class="field full">
                        <label>Sekolah / Kuliah / Kerja di</label>
                        <input type="text" name="instansi" value="{{ $member->instansi }}" readonly>
                    </div>

                    <div class="field full">
                        <label>Alamat Sekolah / Kampus / Kantor</label>
                        <input type="text" name="alamat_instansi" value="{{ $member->alamat_instansi }}" readonly>
                    </div>
                </div>

                <div class="member-action-row">
                    <button type="button" class="outline-btn" onclick="enableEdit()">Edit</button>
                    <button type="submit" class="primary-btn">Simpan</button>
                </div>
            </form>
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


function enableEdit() {
    document.querySelectorAll('.member-form-grid input[name]').forEach(input => {
        input.removeAttribute('readonly');
    });
}
</script>

</body>
</html>
