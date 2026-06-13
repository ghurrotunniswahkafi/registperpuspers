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
                <small>Update {{ $lastUpdated }}</small>
            </div>

            <table class="dashboard-table">
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
                    @forelse($members as $member)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $member->nomor_keanggotaan ?? str_pad($member->id, 4, '0', STR_PAD_LEFT) . 'MPN' . $member->created_at->format('Y') }}</td>
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
                        <td>
                            <span>{{ $member->created_at->format('d/m/Y') }}</span>
                            <small>{{ $member->created_at->format('H:i') }}</small>
                        </td>
                        <td class="action-cell">
                            {{-- Lihat / Edit detail anggota --}}
                            <a href="{{ route('admin.data-anggota.show', $member->id) }}" class="action-icon edit-icon" title="Detail anggota">
                                <img src="{{ asset('image/icons/icon-edit.png') }}" alt="Detail">
                            </a>

                            {{-- Hapus anggota --}}
                            <form action="{{ route('admin.data-anggota.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="action-icon delete-icon" title="Hapus anggota">
                                    <img src="{{ asset('image/icons/icon-delete.png') }}" alt="Hapus">
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-table">Belum ada anggota terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>

    <div class="right-area">
        <div class="chart-card">
            <div class="chart-head">
                <h3>Tren Pendaftar</h3>
                <span>Semua data</span>
            </div>
            <canvas id="lineChart"></canvas>
        </div>

        <div class="chart-card">
            <div class="chart-head">
                <h3>Sebaran Asal Anggota</h3>
                <span>Realtime dari database</span>
            </div>
            <canvas id="donutChart"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const chartLabels = @json($chartLabels);
const chartValues = @json($chartValues);
const donutLabels = @json($donutLabels);
const donutValues = @json($donutValues);
const hasDonutData = donutValues.length > 0 && donutValues.some((value) => Number(value) > 0);

new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: chartLabels,
        datasets: [{
            label: 'Pendaftar',
            data: chartValues,
            borderColor: '#d946ef',
            borderWidth: 2,
            tension: 0.3,
            fill: false,
            pointRadius: 4,
            pointBackgroundColor: '#fff',
            pointBorderColor: '#d946ef',
            pointBorderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: (context) => `${context.parsed.y} pendaftar`
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    precision: 0
                }
            }
        }
    }
});

new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
        labels: hasDonutData ? donutLabels : ['Belum ada data'],
        datasets: [{
            data: hasDonutData ? donutValues : [1],
            backgroundColor: ['#0071bc', '#62aac8', '#c75c61', '#79b86b', '#f2a65a', '#8b7fd1'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '55%',
        plugins: {
            legend: {
                position: window.innerWidth <= 1400 ? 'bottom' : 'right',
                labels: {
                    boxWidth: 24,
                    padding: 12
                }
            },
            tooltip: {
                callbacks: {
                    label: (context) => {
                        const total = context.dataset.data.reduce((sum, value) => sum + Number(value), 0);
                        const value = Number(context.raw);
                        const percent = total > 0 ? Math.round((value / total) * 100) : 0;
                        if (!hasDonutData) {
                            return 'Belum ada data anggota';
                        }
                        return `${context.label}: ${value} anggota (${percent}%)`;
                    }
                }
            }
        }
    }
});

setTimeout(() => {
    window.location.reload();
}, 60000);
</script>

@endsection
