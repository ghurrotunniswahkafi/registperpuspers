@extends('layouts.app')

@section('title', 'Status Pengajuan')

@section('content')
@php
    $status = $member->status;
    $isValidation = in_array($status, ['validasi', 'selesai']);
    $isCompleted = $status === 'selesai';

    $statusTitle = match ($status) {
        'validasi' => 'Berkas sedang divalidasi',
        'selesai' => 'Pendaftaran telah selesai',
        default => 'Berkas sedang dalam pengecekan',
    };

    $statusDescription = match ($status) {
        'validasi' => 'Petugas sedang memvalidasi data dan dokumen pendaftaran Anda.',
        'selesai' => 'Pendaftaran Anda telah disetujui. Silakan datang ke perpustakaan dengan membawa formulir yang sudah dicetak dan KTP.',
        default => 'Berkas Anda sudah diterima dan sedang menunggu pemeriksaan oleh petugas perpustakaan.',
    };
@endphp

<div class="status-container member-status-page">
    <div class="status-card-main">
        <div class="status-header">
            <p class="status-eyebrow">Keanggotaan Perpustakaan</p>
            <h1 class="status-title">Status Pengajuan Pendaftaran</h1>
            <p class="status-subtitle">
                Halo, <strong>{{ $member->nama }}</strong>. Pantau perkembangan pengajuan keanggotaan Anda di halaman ini.
            </p>
        </div>

        <div class="current-status">
            <span class="status-icon {{ $isCompleted ? 'completed' : ($isValidation ? 'validation' : 'pending') }}">
                <i class="fa-solid {{ $isCompleted ? 'fa-circle-check' : ($isValidation ? 'fa-magnifying-glass' : 'fa-clock') }}"></i>
            </span>
            <div class="current-status-copy">
                <span class="status-label-text">Status Saat Ini</span>
                <h2>{{ $statusTitle }}</h2>
                <p>{{ $statusDescription }}</p>
            </div>
        </div>
    </div>

    <div class="status-card-main progress-section">
        <h2 class="section-title">Tahapan Proses</h2>

        <div class="progress-container">
            <div class="progress-steps">
                <div class="progress-step active {{ $isValidation || $isCompleted ? 'completed' : '' }}">
                    <div class="step-circle">
                        <div class="step-number">
                            @if($isValidation || $isCompleted)
                                <i class="fa-solid fa-check checkmark"></i>
                            @else
                                <span class="number">1</span>
                            @endif
                        </div>
                    </div>
                    <h3 class="step-title">Berkas Diterima</h3>
                    <p class="step-description">Formulir berhasil dikirim</p>
                </div>

                <div class="progress-connector {{ $isValidation ? 'completed' : '' }}"></div>

                <div class="progress-step {{ $isValidation ? 'active' : '' }} {{ $isCompleted ? 'completed' : '' }}">
                    <div class="step-circle">
                        <div class="step-number">
                            @if($isCompleted)
                                <i class="fa-solid fa-check checkmark"></i>
                            @else
                                <span class="number">2</span>
                            @endif
                        </div>
                    </div>
                    <h3 class="step-title">Validasi Petugas</h3>
                    <p class="step-description">Data dan dokumen diperiksa</p>
                </div>

                <div class="progress-connector {{ $isCompleted ? 'completed' : '' }}"></div>

                <div class="progress-step {{ $isCompleted ? 'active completed' : '' }}">
                    <div class="step-circle">
                        <div class="step-number">
                            @if($isCompleted)
                                <i class="fa-solid fa-check checkmark"></i>
                            @else
                                <span class="number">3</span>
                            @endif
                        </div>
                    </div>
                    <h3 class="step-title">Selesai</h3>
                    <p class="step-description">Pendaftaran telah disetujui</p>
                </div>
            </div>
        </div>
    </div>

    <div class="status-help">
        <i class="fa-solid fa-circle-info"></i>
        <p>
            Proses pemeriksaan dilakukan oleh petugas. Silakan periksa halaman ini secara berkala untuk melihat perubahan status.
        </p>
    </div>
</div>
@endsection
