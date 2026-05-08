@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="page-header">
    <div class="d-flex align-items-center mb-2">
        <a href="{{ route('transaksi.index') }}" class="btn btn-light btn-sm me-2">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="page-title mb-0">Detail Transaksi</h1>
    </div>
    <p class="page-subtitle">Informasi lengkap transaksi</p>
</div>

<div class="row g-4">
    <!-- Transaction Info Card -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-body text-center py-4">
                <div class="stat-icon primary mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                    <i class="bi bi-receipt"></i>
                </div>
                <h4 class="mb-1">#TR{{ str_pad($transaksi->id, 4, '0', STR_PAD_LEFT) }}</h4>
                <p class="text-muted mb-2">{{ $transaksi->created_at->format('d/m/Y H:i') }}</p>
                <span class="badge bg-{{ $transaksi->status_badge }} mb-3">
                    {{ $transaksi->status_label }}
                </span>
                
                <h3 class="text-primary mb-3">{{ $transaksi->formatted_total }}</h3>
                
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('transaksi.edit', $transaksi) }}" class="btn btn-light btn-sm">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <button onclick="window.print()" class="btn btn-primary btn-sm">
                        <i class="bi bi-printer me-1"></i> Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Details -->
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header">Informasi Transaksi</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted mb-1">Anggota</label>
                        <div class="d-flex align-items-center">
                            <div class="user-avatar me-2" style="width: 36px; height: 36px; font-size: 0.8rem;">
                                {{ $transaksi->anggota->initials }}
                            </div>
                            <div>
                                <p class="fw-semibold mb-0">{{ $transaksi->anggota->nama }}</p>
                                <small class="text-muted">{{ $transaksi->anggota->no_telp }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted mb-1">Paket Gym</label>
                        <p class="fw-semibold mb-0">{{ $transaksi->paket->nama_paket }}</p>
                        <small class="text-muted">{{ $transaksi->paket->durasi_label }}</small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted mb-1">Waktu Mulai</label>
                        <p class="fw-semibold mb-0">{{ $transaksi->waktu_mulai->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted mb-1">Waktu Berakhir</label>
                        <p class="fw-semibold mb-0 {{ $transaksi->isMembershipActive() ? '' : 'text-danger' }}">
                            {{ $transaksi->waktu_berakhir->format('d/m/Y') }}
                        </p>
                        @if(!$transaksi->isMembershipActive())
                        <small class="text-danger">Sudah berakhir</small>
                        @endif
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted mb-1">Metode Pembayaran</label>
                        <p class="fw-semibold mb-0">{{ $transaksi->payment_method_label }}</p>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label text-muted mb-1">Keterangan</label>
                        <p class="fw-semibold mb-0">{{ $transaksi->keterangan ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Invoice-like Card -->
<div class="card mt-4" id="printArea">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Bukti Transaksi</span>
        <span class="text-muted" style="font-size: 0.875rem;">GymPro</span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6 class="text-muted mb-2">Kepada:</h6>
                <p class="mb-0"><strong>{{ $transaksi->anggota->nama }}</strong></p>
                <p class="mb-0 text-muted">{{ $transaksi->anggota->alamat ?? '-' }}</p>
            </div>
            <div class="col-md-6 text-md-end">
                <h6 class="text-muted mb-2">Detail:</h6>
                <p class="mb-0">No: #TR{{ str_pad($transaksi->id, 4, '0', STR_PAD_LEFT) }}</p>
                <p class="mb-0">Tanggal: {{ $transaksi->created_at->format('d/m/Y') }}</p>
            </div>
        </div>
        
        <hr class="my-4">
        
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Item</th>
                    <th>Durasi</th>
                    <th class="text-end">Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $transaksi->paket->nama_paket }}</td>
                    <td>{{ $transaksi->paket->durasi_label }}</td>
                    <td class="text-end">{{ $transaksi->formatted_total }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-end"><strong>Total:</strong></td>
                    <td class="text-end"><strong class="text-primary">{{ $transaksi->formatted_total }}</strong></td>
                </tr>
            </tfoot>
        </table>
        
        <div class="text-center mt-4">
            <p class="text-muted mb-0">Terima kasih telah berlangganan di GymPro!</p>
            <small class="text-muted">Membership berlaku hingga: {{ $transaksi->waktu_berakhir->format('d F Y') }}</small>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
@media print {
    .sidebar, .top-navbar, .page-header, .btn, form, .alert {
        display: none !important;
    }
    .main-content {
        margin-left: 0 !important;
    }
    .card {
        box-shadow: none !important;
        border: 1px solid #dee2e6 !important;
    }
}
</style>
@endpush