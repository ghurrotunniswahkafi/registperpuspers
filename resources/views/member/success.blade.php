@extends('layouts.app')

@section('content')

<div class="success">
    <div class="icon">✓</div>
    <h2 class="success-title">Pengisian Formulir</h2>
    <h1 class="success-message">Berhasil</h1>
    <p class="success-description">
        Pantau status pengajuan keanggotaan Anda melalui menu Status Pengajuan pada sidebar.<br>
        Unduh dan cetak File berikut sebagai kelengkapan Pengisian Formulir 
        <a href="{{ route('pdf',$member->id) }}" class="success-link"><u>Unduh Disini</u></a>.
    </p>
</div>

@endsection