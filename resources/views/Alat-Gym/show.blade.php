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
                    <div class="equipment-preview mb-4">

        @if($alatGym->gambar)

            <img
                src="{{ asset('storage/'.$alatGym->gambar) }}"
                alt="{{ $alatGym->nama }}"
                class="equipment-detail-image">

        @else

            <div class="equipment-detail-placeholder">

                <i class="bi bi-image"></i>

            </div>

        @endif

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

@push('styles')

<style>

        .equipment-preview{

            display:flex;
            justify-content:center;

        }

        .equipment-detail-image{

            width:100%;

            max-width:240px;

            height:220px;

            object-fit:contain;

            background:#ffffff;

            padding:16px;

            border:1px solid #e5e7eb;

            border-radius:20px;

            box-shadow:
                0 8px 24px rgba(15,23,42,.06);

            transition:all .3s ease;

        }

        .equipment-detail-image:hover{

            transform:translateY(-4px);

            box-shadow:
                0 14px 30px rgba(15,23,42,.10);

        }

        .equipment-detail-placeholder{

            width:240px;

            height:220px;

            display:flex;

            align-items:center;

            justify-content:center;

            background:#f8fafc;

            border:1px solid #e5e7eb;

            border-radius:20px;

            color:#94a3b8;

            font-size:48px;

        }

        </style>

@endpush
@endsection