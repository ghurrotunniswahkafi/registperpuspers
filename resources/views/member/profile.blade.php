@extends('layouts.app')

@section('title', 'Profil Diri')

@section('content')
<div class="member-profile-page">
    <section class="member-profile-card">
        <header class="member-profile-header">
            <div class="member-profile-photo">
                @if($member->foto)
                    <img src="{{ asset('storage/' . $member->foto) }}" alt="Foto {{ $member->nama }}">
                @else
                    <i class="fa-solid fa-user"></i>
                @endif
            </div>

            <div class="member-profile-identity">
                <p class="member-profile-eyebrow">Profil Anggota</p>
                <h1>{{ $member->nama }}</h1>
                <p>{{ $member->email }}</p>
            </div>

            <span class="member-profile-status {{ $member->status }}">
                <i class="fa-solid {{ $member->status === 'selesai' ? 'fa-circle-check' : 'fa-clock' }}"></i>
                {{ $member->status === 'selesai' ? 'Terverifikasi' : 'Dalam Proses' }}
            </span>
        </header>

        <div class="profile-readonly-note">
            <i class="fa-solid fa-lock"></i>
            <span>Data profil ditampilkan sesuai formulir pendaftaran dan hanya dapat dibaca.</span>
        </div>

        <section class="profile-section">
            <h2><i class="fa-solid fa-id-card"></i> Data Pribadi</h2>
            <div class="profile-data-grid">
                <div class="profile-data-item profile-data-wide">
                    <span>Nama Lengkap</span>
                    <strong>{{ $member->nama }}</strong>
                </div>
                <div class="profile-data-item">
                    <span>Asal Alamat</span>
                    <strong>{{ $member->asal_alamat }}</strong>
                </div>
                <div class="profile-data-item">
                    <span>Tempat Lahir</span>
                    <strong>{{ $member->tempat }}</strong>
                </div>
                <div class="profile-data-item">
                    <span>Tanggal Lahir</span>
                    <strong>{{ optional($member->tanggal_lahir)->format('d F Y') ?? '-' }}</strong>
                </div>
                <div class="profile-data-item profile-data-wide">
                    <span>Alamat Rumah</span>
                    <strong>{{ $member->alamat }}</strong>
                </div>
            </div>
        </section>

        <section class="profile-section">
            <h2><i class="fa-solid fa-address-book"></i> Informasi Kontak</h2>
            <div class="profile-data-grid">
                <div class="profile-data-item">
                    <span>No. Telepon / HP</span>
                    <strong>{{ $member->no_hp }}</strong>
                </div>
                <div class="profile-data-item">
                    <span>Alamat Email</span>
                    <strong>{{ $member->email }}</strong>
                </div>
                <div class="profile-data-item">
                    <span>Media Sosial</span>
                    <strong>{{ $member->sosmed ?: '-' }}</strong>
                </div>
            </div>
        </section>

        <section class="profile-section">
            <h2><i class="fa-solid fa-building"></i> Sekolah, Kampus, atau Pekerjaan</h2>
            <div class="profile-data-grid">
                <div class="profile-data-item profile-data-wide">
                    <span>Nama Instansi</span>
                    <strong>{{ $member->instansi ?: '-' }}</strong>
                </div>
                <div class="profile-data-item profile-data-wide">
                    <span>Alamat Instansi</span>
                    <strong>{{ $member->alamat_instansi ?: '-' }}</strong>
                </div>
            </div>
        </section>
    </section>
</div>
@endsection
