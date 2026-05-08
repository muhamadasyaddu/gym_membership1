@extends('layouts.app')

@section('title', 'Detail Paket Gym')

@section('content')
<div class="page-header">
    <div class="d-flex align-items-center mb-2">
        <a href="{{ route('paket-gym.index') }}" class="btn btn-light btn-sm me-2">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="page-title mb-0">Detail Paket Gym</h1>
    </div>
    <p class="page-subtitle">Informasi lengkap paket membership</p>
</div>

<div class="row g-4">
    <!-- Package Info -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-body text-center py-4">
                <div class="stat-icon primary mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                    <i class="bi bi-box-fill"></i>
                </div>
                <h4 class="mb-1">{{ $paketGym->nama_paket }}</h4>
                <p class="text-muted mb-2">{{ $paketGym->durasi_label }}</p>
                <h3 class="text-primary mb-3">{{ $paketGym->formatted_harga }}</h3>
                
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('paket-gym.edit', $paketGym) }}" class="btn btn-light btn-sm">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <a href="{{ route('transaksi.create') }}?paket={{ $paketGym->id }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus me-1"></i> Buat Transaksi
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Details -->
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header">Informasi Paket</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted mb-1">ID Paket</label>
                        <p class="fw-semibold mb-0">#{{ $paketGym->id }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted mb-1">Durasi</label>
                        <p class="fw-semibold mb-0">{{ $paketGym->durasi_hari }} hari</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted mb-1">Harga</label>
                        <p class="fw-semibold mb-0">{{ $paketGym->formatted_harga }}</p>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label text-muted mb-1">Deskripsi</label>
                        <p class="fw-semibold mb-0">{{ $paketGym->deskripsi ?? '-' }}</p>
                    </div>
                </div>
                
                <div class="row mt-2">
                    <div class="col-12">
                        <label class="form-label text-muted mb-1">Total Transaksi</label>
                        <p class="fw-semibold mb-0">{{ $paketGym->transaksi->count() }} transaksi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Transaction History -->
<div class="card mt-4">
    <div class="card-header">Transaksi dengan Paket Ini</div>
    <div class="card-body p-0">
        @if($paketGym->transaksi->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Anggota</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paketGym->transaksi->take(10) as $t)
                    <tr>
                        <td>{{ $t->anggota->nama }}</td>
                        <td>{{ $t->created_at->format('d/m/Y') }}</td>
                        <td>{{ $t->formatted_total }}</td>
                        <td>
                            <span class="badge bg-{{ $t->status_badge }}">{{ $t->status_label }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-4 text-muted">
            <i class="bi bi-receipt" style="font-size: 1.5rem;"></i>
            <p class="mt-2 mb-0">Belum ada transaksi dengan paket ini</p>
        </div>
        @endif
    </div>
</div>
@endsection