@extends('layouts.app')

@section('content')

<div class="success">
    <div class="icon">✓</div>
    <h2 class="success-title">Pengisian Formulir</h2>
    <h1 class="success-message">Berhasil</h1>
    <p class="success-description">
        Unduh dan cetak File berikut sebagai kelengkapan Pengisian Formulir 
        <a href="{{ route('pdf',$member->id) }}" class="success-link">Unduh Disini</a>.
    </p>
</div>

@endsection