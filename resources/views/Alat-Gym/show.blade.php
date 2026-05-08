@extends('layouts.app')

@section('title', 'Detail Alat Gym')

@section('content')
<div class="page-header">
    <div class="d-flex align-items-center mb-2">
        <a href="{{ route('alat-gym.index') }}" class="btn btn-light btn-sm me-2">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="page-title mb-0">Detail Alat Gym</h1>
    </div>
    <p class="page-subtitle">Informasi lengkap alat</p>
</div>

<div class="row g-4">
    <!-- Equipment Info Card -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-body text-center py-4">
                <div class="stat-icon primary mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                    <i class="bi bi-bicycle"></i>
                </div>
                <h4 class="mb-1">{{ $alatGym->nama }}</h4>
                <p class="text-muted mb-2">{{ $alatGym->merek ?? 'Tanpa Merek' }}</p>
                <span class="badge bg-{{ $alatGym->kondisi_badge }} mb-3">
                    {{ $alatGym->kondisi_label }}
                </span>
                
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <a href="{{ route('alat-gym.edit', $alatGym) }}" class="btn btn-light btn-sm">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Details -->
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header">Informasi Alat</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted mb-1">ID Alat</label>
                        <p class="fw-semibold mb-0">#{{ $alatGym->id }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted mb-1">Nama</label>
                        <p class="fw-semibold mb-0">{{ $alatGym->nama }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted mb-1">Merek</label>
                        <p class="fw-semibold mb-0">{{ $alatGym->merek ?? '-' }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted mb-1">Kondisi</label>
                        <p class="fw-semibold mb-0">
                            <span class="badge bg-{{ $alatGym->kondisi_badge }}">{{ $alatGym->kondisi_label }}</span>
                        </p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted mb-1">Tanggal Pembelian</label>
                        <p class="fw-semibold mb-0">
                            {{ $alatGym->waktu_pembelian ? $alatGym->waktu_pembelian->format('d/m/Y') : '-' }}
                        </p>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label text-muted mb-1">Keterangan</label>
                        <p class="fw-semibold mb-0">{{ $alatGym->keterangan ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection