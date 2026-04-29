@extends('layouts.admin')

@section('title', 'LAPORAN')

@section('content')

<form method="GET" action="{{ route('admin.laporan') }}" class="report-filter">
    <div class="period-box">
        <span>Periode</span>

        <select name="periode">
            <option value="2026-04" {{ request('periode') == '2026-04' ? 'selected' : '' }}>April 2026</option>
            <option value="2026-03" {{ request('periode') == '2026-03' ? 'selected' : '' }}>Maret 2026</option>
            <option value="2026-02" {{ request('periode') == '2026-02' ? 'selected' : '' }}>Februari 2026</option>
        </select>
    </div>

    <div class="report-buttons">
        <button type="submit" class="btn-see">Lihat</button>

        <a href="{{ route('admin.laporan.excel', request()->query()) }}" class="btn-download">
            <img src="{{ asset('image/icons/logo-load.png') }}" alt="">
            <span>Excel</span>
        </a>

        <a href="{{ route('admin.laporan.pdf', request()->query()) }}" class="btn-download">
            <img src="{{ asset('image/icons/logo-load.png') }}" alt="">
            <span>PDF</span>
        </a>
    </div>
</form>

<div class="report-card">
    <div class="report-stats">
        <div>
            <p>Anggota Terdaftar</p>
            <strong>{{ $members->count() }} orang</strong>
        </div>
    </div>

    <div class="report-table-head">
        <h3>Daftar anggota perpustakaan</h3>
        <span>‹ › &nbsp; ...</span>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Keanggotaan</th>
                <th>Nama Anggota</th>
                <th>Jenis Keanggotaan</th>
            </tr>
        </thead>

        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>
                    {{ str_pad($member->id, 4, '0', STR_PAD_LEFT) }}MPN{{ \Carbon\Carbon::parse($member->created_at)->format('Y') }}
                </td>
                <td>
                    <span class="avatar">
                        {{ strtoupper(substr($member->nama, 0, 2)) }}
                    </span>
                    {{ $member->nama }}
                </td>
                <td>{{ $member->asal_alamat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="report-note">
        Menampilkan {{ $members->count() }} data
    </p>
</div>

@endsection