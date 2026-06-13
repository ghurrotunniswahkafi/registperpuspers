@extends('layouts.app')

@section('content')
<div class="success-page">
    <div class="success-panel">
        <div class="success text-center">
            <div class="icon">✓</div>
            <p class="success-eyebrow">Pendaftaran Terkirim</p>
            <h1 class="success-message">Berhasil</h1>
            <h2 class="success-greeting">Halo, {{ $member->nama }}!</h2>
            <p class="success-description success-intro">
                Data pendaftaran keanggotaan Anda telah kami terima dan sedang menunggu proses pemeriksaan oleh petugas.
            </p>

            <div class="success-steps">
                <h2>Langkah Selanjutnya</h2>

                <div class="success-step">
                    <span class="success-step-number">1</span>
                    <div>
                        <h3>Pantau status pengajuan</h3>
                        <p>Lihat perkembangan pemeriksaan melalui menu Status Pengajuan.</p>
                    </div>
                </div>

                <div class="success-step">
                    <span class="success-step-number">2</span>
                    <div>
                        <h3>Unduh dan cetak formulir</h3>
                        <p>Simpan formulir sebagai kelengkapan pendaftaran Anda.</p>
                    </div>
                </div>

                <div class="success-step">
                    <span class="success-step-number">3</span>
                    <div>
                        <h3>Tunggu proses validasi</h3>
                        <p>Petugas akan memeriksa data sebelum pendaftaran dinyatakan selesai.</p>
                    </div>
                </div>
            </div>

            <div class="success-actions">
                <a href="{{ route('status') }}" class="success-action success-action-primary">
                    <i class="fa-solid fa-chart-line"></i>
                    Pantau Status
                </a>
                <a href="{{ route('pdf', $member->id) }}" class="success-action success-action-secondary">
                    <i class="fa-solid fa-file-arrow-down"></i>
                    Unduh Formulir
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
