<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Calibri, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            color: #111;
        }
        .page {
            padding: 28px 32px;
        }
        .top-right {
            text-align: right;
            font-size: 11px;
            margin-bottom: 12px;
        }
        .top-right .line {
            display: block;
            margin-bottom: 4px;
        }
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 15px;
            margin: 0 0 22px 0;
            line-height: 1.2;
        }
        .section-title {
            margin: 18px 0 8px 0;
            text-transform: uppercase;
            font-size: 12px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table td {
            vertical-align: top;
            padding: 4px 0;
        }
        .data-table td:first-child {
            width: 210px;
        }
        .data-table td:last-child {
            width: calc(100% - 210px);
        }
        .note {
            margin: 18px 0 18px 0;
            font-size: 11px;
            line-height: 1.4;
        }
        .right-line {
            margin-top: 8px;
            text-align: right;
            font-size: 12px;
        }
        .signature-box {
            margin-top: 8px;
            text-align: right;
            font-size: 12px;
        }
        .signature-line {
            display: inline-block;
            min-width: 200px;
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
        }
        .signature-label {
            margin-top: 6px;
            text-align: center;
            font-size: 11px;
        }
        .divider {
            border-top: 1px solid #000;
            margin: 26px 0 12px 0;
        }
        .pengesahan-header {
            margin-bottom: 8px;
            font-size: 12px;
        }
        .pengesahan-paragraph {
            margin-top: 10px;
            font-size: 11px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="top-right">
            <span class="line">No. Pendaftaran : ________________________</span>
            <span class="line">Tgl. Pendaftaran : ________________________</span>
        </div>

        <div class="title">
            FORMULIR PENDAFTARAN ANGGOTA PERPUSTAKAAN<br>
            MONUMEN PERS NASIONAL
        </div>

        <div class="section-title">Data Calon Anggota</div>
        <table class="data-table">
            <tr>
                <td>Nama Lengkap</td>
                <td>: {{ $member->nama }}</td>
            </tr>
            <tr>
                <td>Tempat / Tanggal Lahir</td>
                <td>: {{ $member->tempat }} / {{ is_string($member->tanggal_lahir) ? $member->tanggal_lahir : optional($member->tanggal_lahir)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td>No. KTP / SIM / NIM / dsb</td>
                <td>: {{ $member->no_identitas }}</td>
            </tr>
            <tr>
                <td>Alamat Rumah (sesuai kartu identitas)</td>
                <td>: {{ $member->alamat }}</td>
            </tr>
            <tr>
                <td>No. Telepon / HP</td>
                <td>: {{ $member->no_hp }}</td>
            </tr>
            <tr>
                <td>Alamat Email</td>
                <td>: {{ $member->email }}</td>
            </tr>
            <tr>
                <td>Social Media (FB / Twitter / IG / dll)</td>
                <td>: {{ $member->sosmed ?? '-' }}</td>
            </tr>
            <tr>
                <td>Sekolah / Kuliah / Kerja di</td>
                <td>: {{ $member->instansi ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat Sekolah / Kampus / Kantor</td>
                <td>: {{ $member->alamat_instansi ?? '-' }}</td>
            </tr>
        </table>

        <div class="note">
            [!] Dengan ini berjanji akan menjadi Anggota Perpustakaan Monumen Pers Nasional yang sanggup menaati segala peraturan yang ada, sanggup mengganti buku-buku yang rusak atau hilang selama peminjaman, dan menerima sanksi yang dikenakan.
        </div>

        <div class="right-line">Surakarta, ____________________________</div>

        <div class="signature-box">
            <div>
                <br><br><br>
                <div class="signature-box">({{ $member->nama }})</div>
            </div>
        </div>

        @if($member->asal_alamat === 'Lainnya')
            <div class="divider"></div>
            <div class="pengesahan-header">PENGESAHAN</div>
            <div>Yang bertanda tangan di bawah ini:</div>
            <table class="data-table" style="margin-top: 8px;">
                <tr>
                    <td>Nama</td>
                    <td>: {{ $member->pengesahan_nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>: {{ $member->pengesahan_jabatan ?? '-' }}</td>
                </tr>
                <tr>
                    <td>No. Telp/HP</td>
                    <td>: {{ $member->pengesahan_no_hp ?? '-' }}</td>
                </tr>
            </table>
            <div class="pengesahan-paragraph">
                Menerangkan bahwa Sdr/Sdri {{ $member->nama }} saya kenal dengan baik dan dapat dipercaya dalam menaati segala peraturan yang diterapkan oleh Perpustakaan Monumen Pers Nasional.
            </div>
            <div class="right-line" style="margin-top: 24px;">Mengetahui,</div>
            <div class="signature-box">
                <div>
                    <br><br><br>
                    <div class="signature-box">({{ $member->pengesahan_nama ?? '-' }})</div>
                </div>
            </div>
        @endif
    </div>
</body>
</html>