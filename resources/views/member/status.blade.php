@extends('layouts.app')

@section('content')

<div class="status-container">
    <!-- Header Section -->
    <div class="status-card-main">
        <div class="status-header">
            <h1 class="status-title">Status Pengajuan Pendaftaran</h1>
            <p class="status-subtitle">Pantau progres pengajuan keanggotaan Anda di sini</p>
        </div>

        <!-- Current Status Display -->
        <div class="current-status">
            <span class="status-label-text">Status Saat Ini:</span>
            <span class="status-badge {{ $member->status }}">
                @if($member->status == 'pending' || $member->status == 'checking')
                    <span class="status-dot pending"></span> Menunggu Pengecekan
                @elseif($member->status == 'validated')
                    <span class="status-dot validated"></span> Telah Divalidasi
                @elseif($member->status == 'printed')
                    <span class="status-dot printed"></span> Selesai Dicetak
                @endif
            </span>
        </div>
    </div>

    <!-- Progress Bar Section -->
    <div class="status-card-main progress-section">
        <h3 class="section-title">Tahapan Proses</h3>
        
        <div class="progress-container">
            <div class="progress-steps">
                <!-- Step 1: Pengecekan -->
                <div class="progress-step 
                    @if(in_array($member->status, ['pending','checking','validated','printed'])) active @endif
                    @if(in_array($member->status, ['validated','printed'])) completed @endif">
                    <div class="step-circle">
                        <div class="step-number">
                            @if(in_array($member->status, ['validated','printed']))
                                <span class="checkmark">✓</span>
                            @else
                                @if(in_array($member->status, ['pending','checking']))
                                    <span class="number">1</span>
                                @else
                                    <span class="number">1</span>
                                @endif
                            @endif
                        </div>
                    </div>
                    <h4 class="step-title">Pengecekan Berkas</h4>
                    <p class="step-description">Berkas diperiksa</p>
                </div>

                <!-- Connector Line 1 -->
                <div class="progress-connector 
                    @if(in_array($member->status, ['validated','printed'])) active @endif">
                </div>

                <!-- Step 2: Validasi -->
                <div class="progress-step 
                    @if(in_array($member->status, ['validated','printed'])) active @endif
                    @if($member->status == 'printed') completed @endif">
                    <div class="step-circle">
                        <div class="step-number">
                            @if($member->status == 'printed')
                                <span class="checkmark">✓</span>
                            @else
                                <span class="number">2</span>
                            @endif
                        </div>
                    </div>
                    <h4 class="step-title">Validasi</h4>
                    <p class="step-description">Berkas divalidasi</p>
                </div>

                <!-- Connector Line 2 -->
                <div class="progress-connector 
                    @if($member->status == 'printed') active @endif">
                </div>

                <!-- Step 3: Kartu Dicetak -->
                <div class="progress-step 
                    @if($member->status == 'printed') active completed @endif">
                    <div class="step-circle">
                        <div class="step-number">
                            <span class="number">3</span>
                        </div>
                    </div>
                    <h4 class="step-title">Kartu Dicetak</h4>
                    <p class="step-description">Kartu selesai</p>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Additional Info -->
    @if($member->status == 'checking' || $member->status == 'pending')
        <div class="alert-info">
            <span class="alert-icon">ℹ</span>
            <div class="alert-content">
                <h5>Informasi:</h5>
                <p>Pengajuan Anda sedang diproses. Kami akan memberikan notifikasi saat ada perkembangan terbaru.</p>
            </div>
        </div>
    @elseif($member->status == 'validated')
        <div class="alert-warning">
            <span class="alert-icon">⚠</span>
            <div class="alert-content">
                <h5>Pemberitahuan:</h5>
                <p>Berkas Anda telah lolos validasi. Kartu Anda sedang dalam proses pencetakan.</p>
            </div>
        </div>
    @elseif($member->status == 'printed')
        <div class="alert-success">
            <span class="alert-icon">✓</span>
            <div class="alert-content">
                <h5>Selamat!</h5>
                <p>Kartu anggota Anda sudah siap. Silakan ambil di meja administrasi perpustakaan.</p>
            </div>
        </div>
    @endif
</div>

@endsection