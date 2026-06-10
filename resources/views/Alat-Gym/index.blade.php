@extends('layouts.app')

@section('title', 'Alat Gym')

@section('content')
<!-- ============================================ -->
<!-- PAGE HEADER (JUDUL & SUB JUDUL)               -->
<!-- ============================================ -->
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div>
        <h1 class="page-title">Alat Gym</h1>
        <p class="page-subtitle">Kelola inventaris alat gym</p>
    </div>
    <a href="{{ route('alat-gym.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i> Tambah Alat
    </a>
</div>

@push('styles')
<style>
    /* ============================================ */
    /* GAYA KONSISTEN UNTUK SEMUA ELEMEN           */
    /* ============================================ */
    
    .equipment-image {
        width: 120px;
        height: 90px;
        object-fit: contain;
        padding: 8px;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    }

    .equipment-image:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e1;
    }

    .equipment-name {
        font-weight: 500;
        font-size: 0.9rem;
        color: #1e293b;
        line-height: 1.4;
        max-width: 200px;
        word-break: break-word;
    }

    tr:hover .equipment-name {
        color: #0f766e;
        transition: color 0.2s ease;
    }

    .equipment-placeholder {
        width: 120px;
        height: 90px;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        color: #94a3b8;
        font-size: 28px;
        transition: all 0.2s ease;
    }

    .equipment-placeholder:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }

    .table tbody tr {
        transition: background-color 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: #f8fafc;
    }

    .table tbody tr td {
        vertical-align: middle;
        padding: 14px 8px;
    }

    /* ============================================ */
    /* TOMBOL KONSISTEN (DETAIL, EDIT, HAPUS)      */
    /* ============================================ */
    .btn-group .btn {
        min-width: 36px;
        height: 32px;
        padding: 0 10px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    
    .btn-group .btn:hover {
        transform: translateY(-1px);
    }
    
    .btn-group form {
        display: inline-block;
    }

    .badge {
        font-weight: 500;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
    }

    .keterangan-text {
        max-width: 180px;
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #64748b;
        font-size: 0.85rem;
    }

    .table thead th {
        background: #f8fafc;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        color: #475569;
        padding: 14px 8px;
        border-bottom: 1px solid #e2e8f0;
    }
    
    /* Card style */
    .card-border-custom {
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        transition: all 0.2s ease;
    }
    
    .card-border-custom:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
    }
</style>
@endpush

<!-- ============================================ -->
<!-- SEARCH & FILTER CARD                         -->
<!-- ============================================ -->
<div class="card card-border-custom mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control border-start-0 ps-0" name="search" 
                           value="{{ request('search') }}" placeholder="Cari nama atau merek...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="kondisi">
                    <option value="">Semua Kondisi</option>
                    <option value="baik" {{ request('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                    <option value="rusak_ringan" {{ request('kondisi') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="rusak_berat" {{ request('kondisi') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-light px-4">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                <a href="{{ route('alat-gym.index') }}" class="btn btn-link text-muted">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- ============================================ -->
<!-- TABLE DATA ALAT GYM                          -->
<!-- ============================================ -->
<div class="card card-border-custom">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 140px">FOTO</th>
                        <th style="width: 200px">NAMA ALAT</th>
                        <th style="width: 130px">MEREK</th>
                        <th style="width: 100px">KONDISI</th>
                        <th style="width: 120px">TANGGAL PEMBELIAN</th>
                        <th>KETERANGAN</th>
                        <th style="width: 110px">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alat as $item)
                    <tr>
                        <td class="text-center">
                            @if($item->gambar)
                                <img src="{{ asset('storage/'.$item->gambar) }}"
                                     alt="{{ $item->nama }}"
                                     class="equipment-image"
                                     loading="lazy">
                            @else
                                <div class="equipment-placeholder">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="equipment-name" title="{{ $item->nama }}">
                                {{ $item->nama }}
                            </div>
                        </td>
                        <td class="text-muted">{{ $item->merek ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $item->kondisi_badge }}">
                                {{ $item->kondisi_label }}
                            </span>
                        </td>
                        <td class="text-muted small">
                            {{ $item->waktu_pembelian ? $item->waktu_pembelian->format('d/m/Y') : '-' }}
                        </td>
                        <td>
                            @if($item->keterangan)
                                <span class="keterangan-text" title="{{ $item->keterangan }}">
                                    {{ $item->keterangan }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('alat-gym.show', $item) }}" 
                                   class="btn btn-sm btn-light" 
                                   title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('alat-gym.edit', $item) }}" 
                                   class="btn btn-sm btn-light" 
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('alat-gym.destroy', $item) }}" 
                                      method="POST" 
                                      class="d-inline" 
                                      onsubmit="return confirm('Yakin hapus alat {{ $item->nama }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: #cbd5e1;"></i>
                            <p class="text-muted mt-3 mb-0">Belum ada data alat gym</p>
                            <a href="{{ route('alat-gym.create') }}" class="btn btn-sm btn-primary mt-3">
                                <i class="bi bi-plus-lg me-1"></i> Tambah alat pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($alat->hasPages())
    <div class="card-footer bg-white border-top">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted small">
                Menampilkan {{ $alat->firstItem() ?? 0 }} - {{ $alat->lastItem() ?? 0 }} dari {{ $alat->total() }} data
            </div>
            <div>
                {{ $alat->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection