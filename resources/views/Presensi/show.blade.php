@extends('layouts.app')

@section('title', 'Detail Presensi')

@section('content')
<div class="page-header">
    <div class="d-flex align-items-center mb-2">
        <a href="{{ route('presensi.index') }}" class="btn btn-light btn-sm me-2">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="page-title mb-0">Detail Presensi</h1>
    </div>
    <p class="page-subtitle">Informasi kehadiran anggota</p>
</div>

<div class="row g-4">
    <!-- Presensi Info Card -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-body text-center py-4">
                <div class="stat-icon success mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                    <i class="bi bi-calendar-check-fill"></i>
                </div>
                <h4 class="mb-1">{{ $presensi->tanggal }}</h4>
                <p class="text-muted mb-2">Jam {{ $presensi->jam }}</p>
                <span class="badge bg-{{ $presensi->anggota->status_badge }} mb-3">
                    {{ $presensi->anggota->status_label }}
                </span>
                
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <a href="{{ route('presensi.edit', $presensi) }}" class="btn btn-light btn-sm">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Details -->
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header">Informasi Presensi</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted mb-1">ID Presensi</label>
                        <p class="fw-semibold mb-0">#{{ $presensi->id }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted mb-1">Waktu Masuk</label>
                        <p class="fw-semibold mb-0">{{ $presensi->formatted_waktu }}</p>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <h6 class="text-muted mb-3">Data Anggota</h6>
                <div class="d-flex align-items-center">
                    <div class="user-avatar me-3" style="width: 48px; height: 48px; font-size: 1rem;">
                        {{ $presensi->anggota->initials }}
                    </div>
                    <div>
                        <h5 class="mb-1">{{ $presensi->anggota->nama }}</h5>
                        <p class="text-muted mb-0">{{ $presensi->anggota->no_telp }}</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted mb-1">Jenis Kelamin</label>
                        <p class="fw-semibold mb-0">{{ $presensi->anggota->jenis_kelamin_label }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted mb-1">Tanggal Daftar</label>
                        <p class="fw-semibold mb-0">{{ $presensi->anggota->tanggal_daftar->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted mb-1">Status</label>
                        <p class="fw-semibold mb-0">
                            <span class="badge bg-{{ $presensi->anggota->status_badge }}">
                                {{ $presensi->anggota->status_label }}
                            </span>
                        </p>
                    </div>
                </div>
                
                <div class="mt-3">
                    <a href="{{ route('anggota.show', $presensi->anggota) }}" class="btn btn-light">
                        <i class="bi bi-eye me-1"></i> Lihat Profil Anggota
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection