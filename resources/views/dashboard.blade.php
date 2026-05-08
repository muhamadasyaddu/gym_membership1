@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <p class="page-subtitle">Selamat datang kembali, {{ auth()->user()->nama }}!</p>
</div>

<!-- Statistics -->
<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="bi bi-people-fill"></i>
            </div>
            <div>
                <div class="stat-value">{{ $totalAnggota }}</div>
                <div class="stat-label">Total Anggota</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon success">
                <i class="bi bi-person-check-fill"></i>
            </div>
            <div>
                <div class="stat-value">{{ $anggotaAktif }}</div>
                <div class="stat-label">Anggota Aktif</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="bi bi-calendar-check-fill"></i>
            </div>
            <div>
                <div class="stat-value">{{ $presensiHariIni }}</div>
                <div class="stat-label">Presensi Hari Ini</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon info">
                <i class="bi bi-cash-stack"></i>
            </div>
            <div>
                <div class="stat-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                <div class="stat-label">Total Pendapatan</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Chart -->
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Grafik Pendapatan & Transaksi</span>
                <span class="text-muted" style="font-size: 0.875rem;">6 Bulan Terakhir</span>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="300"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Equipment Status -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">Status Alat Gym</div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon success me-3" style="width: 48px; height: 48px; font-size: 1.25rem;">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div>
                        <div class="stat-value">{{ $alatBaik }}</div>
                        <div class="stat-label">Alat Kondisi Baik</div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="stat-icon warning me-3" style="width: 48px; height: 48px; font-size: 1.25rem;">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div>
                        <div class="stat-value">{{ $alatRusak }}</div>
                        <div class="stat-label">Alat Perlu Perbaikan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-0">
    <!-- Recent Transactions -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Transaksi Terbaru</span>
                <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-light">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                @if($recentTransactions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Anggota</th>
                                <th>Paket</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTransactions as $transaksi)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                            {{ $transaksi->anggota->initials }}
                                        </div>
                                        {{ $transaksi->anggota->nama }}
                                    </div>
                                </td>
                                <td>{{ $transaksi->paket->nama_paket }}</td>
                                <td>{{ $transaksi->formatted_total }}</td>
                                <td>{{ $transaksi->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-receipt" style="font-size: 2rem;"></i>
                    <p class="mt-2 mb-0">Belum ada transaksi</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Expiring Memberships -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Membership Akan Berakhir</span>
                <span class="badge bg-warning">7 Hari Kedepan</span>
            </div>
            <div class="card-body p-0">
                @if($expiringMemberships->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Anggota</th>
                                <th>Paket</th>
                                <th>Berakhir</th>
                                <th>Sisa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expiringMemberships as $transaksi)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                            {{ $transaksi->anggota->initials }}
                                        </div>
                                        {{ $transaksi->anggota->nama }}
                                    </div>
                                </td>
                                <td>{{ $transaksi->paket->nama_paket }}</td>
                                <td>{{ $transaksi->waktu_berakhir->format('d/m/Y') }}</td>
                                <td>
                                    @php
                                    $sisa = now()->diffInDays($transaksi->waktu_berakhir, false);
                                    @endphp
                                    @if($sisa <= 0)
                                        <span class="badge bg-danger">Hari ini</span>
                                    @elseif($sisa <= 3)
                                        <span class="badge bg-warning">{{ $sisa }} hari</span>
                                    @else
                                        <span class="badge bg-info">{{ $sisa }} hari</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-calendar-check" style="font-size: 2rem;"></i>
                    <p class="mt-2 mb-0">Tidak ada membership yang akan berakhir</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .stat-card {
        background: #fff;
        border-radius: 0.75rem;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        height: 100%;
    }
</style>
@endpush

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [
                {
                    label: 'Pendapatan (Rp)',
                    data: {!! json_encode($chartData['pendapatan']) !!},
                    backgroundColor: 'rgba(79, 70, 229, 0.8)',
                    borderRadius: 6,
                    yAxisID: 'y'
                },
                {
                    label: 'Jumlah Transaksi',
                    data: {!! json_encode($chartData['transaksi']) !!},
                    backgroundColor: 'rgba(34, 197, 94, 0.8)',
                    borderRadius: 6,
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    grid: {
                        color: '#f1f5f9'
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    grid: {
                        drawOnChartArea: false
                    }
                }
            }
        }
    });
</script>
@endpush