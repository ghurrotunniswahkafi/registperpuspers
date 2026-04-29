<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Anggota Perpustakaan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #222;
        }

        h2 {
            text-align: center;
            margin-bottom: 4px;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 20px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #e5e5e5;
            font-weight: bold;
        }

        th, td {
            border: 1px solid #333;
            padding: 7px;
            text-align: left;
        }

        .footer {
            margin-top: 18px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>

<body>
    <h2>Laporan Anggota Perpustakaan</h2>
    <div class="subtitle">Perpustakaan Monumen Pers Nasional</div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Keanggotaan</th>
                <th>Nama Anggota</th>
                <th>Jenis / Asal</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>

        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ str_pad($member->id, 4, '0', STR_PAD_LEFT) }}MPN{{ \Carbon\Carbon::parse($member->created_at)->format('Y') }}
                </td>
                <td>{{ $member->nama }}</td>
                <td>{{ $member->asal_alamat }}</td>
                <td>{{ \Carbon\Carbon::parse($member->created_at)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Total data: {{ $members->count() }} anggota
    </div>
</body>
</html>