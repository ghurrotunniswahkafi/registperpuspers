@extends('layouts.admin')

@section('title', 'LAPORAN')

@section('content')

<form method="GET" action="{{ route('admin.laporan') }}" class="report-filter">
    <div class="period-box">
        <span>Periode</span>

        <input type="month" name="periode" value="{{ $periode }}" class="month-picker">
    </div>

    <div class="report-buttons">
        <button type="submit" class="btn-see">Lihat</button>

        <a href="{{ route('admin.laporan.excel', ['periode' => $periode]) }}" class="btn-download">
            <img src="{{ asset('image/icons/logo-load.png') }}" alt="">
            <span>Excel</span>
        </a>

        <a href="{{ route('admin.laporan.pdf', ['periode' => $periode]) }}" class="btn-download">
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
                    {{ $member->nomor_keanggotaan ?? str_pad($member->id, 4, '0', STR_PAD_LEFT) . 'MPN' . \Carbon\Carbon::parse($member->created_at)->format('Y') }}
                </td>
                <td>
                    <span class="avatar">
                        @if($member->foto)
                            <img src="{{ asset('storage/' . $member->foto) }}" alt="{{ $member->nama }}">
                        @else
                            {{ strtoupper(substr($member->nama, 0, 2)) }}
                        @endif
                    </span>
                    {{ $member->nama }}
                </td>
                <td>{{ $member->jenis_keanggotaan ?? 'Umum' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="report-note">
        Menampilkan {{ $members->count() }} data
    </p>
</div>

@endsection
