@extends('layouts.admin')

@section('title', 'DASHBOARD')

@section('content')

<div class="dashboard-grid">

    <!-- LEFT -->
    <div class="left-area">

        <div class="stats">
            <div class="stat-card">
                <p>Pendaftar Hari Ini</p>
                <h2>{{ $todayCount }} Orang</h2>
                <span class="badge">{{ $percentage }}%</span>
            </div>

            <div class="stat-card">
                <p>Perlu Ditinjau</p>
                <h2>{{ $reviewCount }} Orang</h2>
                <a href="{{ route('admin.verifikasi') }}" class="lihat-link">Lihat ></a>
            </div>

            <div class="stat-card">
                <p>Anggota Terdaftar</p>
                <h2>{{ $memberCount }} Orang</h2>
                <a href="{{ route('admin.data-anggota') }}" class="lihat-link">Lihat ></a>
            </div>
        </div>

        <div class="table-card">
            <div class="table-head">
                <h2>Anggota Terdaftar</h2>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($members as $member)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $member->id }}</td>
                        <td>{{ $member->nama }}</td>
                        <td>{{ $member->created_at }}</td>
                        <td class="action-cell">
                            {{-- Lihat / Edit detail anggota --}}
                            <a href="{{ route('admin.data-anggota.show', $member->id) }}" class="action-icon edit-icon">
                                <img src="{{ asset('image/icons/icon-edit.png') }}" alt="Edit">
                            </a>

                            {{-- Print PDF anggota --}}
                            <a href="{{ route('pdf', $member->id) }}" class="action-icon print-icon" target="_blank">
                                <img src="{{ asset('image/icons/icon-print.png') }}" alt="Print">
                            </a>

                            {{-- Hapus anggota --}}
                            <form action="{{ route('admin.data-anggota.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="action-icon delete-icon">
                                    <img src="{{ asset('image/icons/icon-delete.png') }}" alt="Delete">
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

        <div class="right-area">
            <div class="chart-card">
                <h3>Sebaran Asal Anggota</h3>
                <canvas id="lineChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>Sebaran Asal Anggota</h3>
                <canvas id="donutChart"></canvas>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const chartLabels = @json($chartLabels);
const chartValues = @json($chartValues);

new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: chartLabels,
        datasets: [{
            data: chartValues,
            borderColor: '#d946ef',
            borderWidth: 2,
            tension: 0.3,
            fill: false,
            pointRadius: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
        labels: ['Surakarta, Sukoharjo, Karanganyar', 'Lainnya'],
        datasets: [{
            data: [{{ $soloRaya }}, {{ $lainnya }}],
            backgroundColor: ['#c75c61', '#62aac8'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '55%',
        plugins: {
            legend: {
                position: 'right'
            }
        }
    }
});
</script>

@endsection