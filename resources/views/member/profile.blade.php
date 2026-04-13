@extends('layouts.app')

@section('content')

<div class="card profile-box">
    <h2>PROFIL DIRI</h2>

    <div class="form-row">
        <div class="form-group full">
            <label>Nama Lengkap</label>
            <input class="input" value="{{ $member->nama }}" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>No. KTP / SIM / NIM / dsb</label>
            <input class="input" value="{{ $member->no_identitas }}" disabled>
        </div>
        <div class="form-group">
            <label>Asal Alamat KTP</label>
            <input class="input" value="{{ $member->asal_alamat }}" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Tempat</label>
            <input class="input" value="{{ $member->tempat }}" disabled>
        </div>
        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input class="input" value="{{ is_string($member->tanggal_lahir) ? $member->tanggal_lahir : optional($member->tanggal_lahir)->format('d/m/Y') }}" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group full">
            <label>Alamat Rumah</label>
            <input class="input" value="{{ $member->alamat }}" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>No. Telepon / HP</label>
            <input class="input" value="{{ $member->no_hp }}" disabled>
        </div>
        <div class="form-group">
            <label>Alamat Email</label>
            <input class="input" value="{{ $member->email }}" disabled>
        </div>
        <div class="form-group">
            <label>Media Sosial</label>
            <input class="input" value="{{ $member->sosmed ?? '-' }}" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group full">
            <label>Sekolah / Kuliah / Kerja di</label>
            <input class="input" value="{{ $member->instansi ?? '-' }}" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group full">
            <label>Alamat Sekolah / Kampus / Kantor</label>
            <input class="input" value="{{ $member->alamat_instansi ?? '-' }}" disabled>
        </div>
    </div>

</div>

@endsection