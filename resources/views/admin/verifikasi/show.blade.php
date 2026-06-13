<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Verifikasi</title>
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

        <section class="detail-card">
            <div class="detail-title">
                <a href="{{ route('admin.verifikasi') }}" aria-label="Kembali ke daftar verifikasi">&lsaquo;</a>
                <h2>{{ $member->nama }}</h2>
            </div>

            <div class="preview-row">
                <div>
                    <div class="preview-box small">
                        @if($member->foto)
                            <img src="{{ asset('storage/' . $member->foto) }}">
                        @else
                            <span>&#8857;<br>Preview</span>
                        @endif
                    </div>
                    <p>Foto Profil</p>
                </div>

            </div>

            <div class="form-grid">
                <div class="field select-field">
                    <label>Jenis Keanggotaan</label>
                    <select name="jenis_keanggotaan" form="approve-form">
                        <option value="Umum" {{ ($member->jenis_keanggotaan ?? 'Umum') === 'Umum' ? 'selected' : '' }}>Umum</option>
                        <option value="Mahasiswa" {{ $member->jenis_keanggotaan === 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        <option value="Pelajar" {{ $member->jenis_keanggotaan === 'Pelajar' ? 'selected' : '' }}>Pelajar</option>
                        <option value="Pegawai MPN" {{ $member->jenis_keanggotaan === 'Pegawai MPN' ? 'selected' : '' }}>Pegawai MPN</option>
                    </select>
                </div>

                <div class="field">
                    <label>Nomor Keanggotaan</label>
                    <input
                        type="text"
                        name="nomor_keanggotaan"
                        value="{{ $member->nomor_keanggotaan ?? str_pad($member->id, 4, '0', STR_PAD_LEFT) . 'MPN' . $member->created_at->format('Y') }}"
                        form="approve-form"
                    >
                </div>

                <div class="field">
                    <label>Tempat</label>
                    <div>{{ $member->tempat }}</div>
                </div>

                <div class="field">
                    <label>Tanggal Lahir</label>
                    <div>{{ optional($member->tanggal_lahir)->format('d/m/Y') }}</div>
                </div>

                <div class="field full">
                    <label>Alamat Rumah</label>
                    <div>{{ $member->alamat }}</div>
                </div>

                <div class="field">
                    <label>No. Telepon / HP</label>
                    <div>{{ $member->no_hp }}</div>
                </div>

                <div class="field">
                    <label>Alamat Email</label>
                    <div>{{ $member->email }}</div>
                </div>

                <div class="field">
                    <label>Media Sosial</label>
                    <div>{{ $member->sosmed ?? '-' }}</div>
                </div>

                <div class="field full">
                    <label>Sekolah / Kuliah / Kerja di</label>
                    <div>{{ $member->instansi ?? '-' }}</div>
                </div>

                <div class="field full">
                    <label>Alamat Sekolah / Kampus / Kantor</label>
                    <div>{{ $member->alamat_instansi ?? '-' }}</div>
                </div>
            </div>

            <div class="action-row">
                <div class="catatan-box">
                    <label class="catatan-label">
                        Beri catatan : <span>*jika masih ada kesalahan</span>
                    </label>
                    <textarea placeholder="Beri catatan jika masih ada penulisan pada berkas yang kurang tepat"></textarea>
                </div> 
                <div class="right-section">
                    <form method="POST" action="{{ route('admin.verifikasi.setujui', $member->id) }}" id="approve-form">
                        @csrf
                        <button type="submit" class="primary-btn">Setujui</button>
                    </form>
                </div>
            </div>
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
