@extends('layouts.app')

@section('title', 'Alat Gym')

@section('content')
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div>
        <h1 class="page-title">Alat Gym</h1>
        <p class="page-subtitle">Kelola inventaris alat gym</p>
    </div>
    <a href="{{ route('alat-gym.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i> Tambah Alat
    </a>
</div>

<!-- Search & Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" name="search" 
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
                <button type="submit" class="btn btn-light">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                <a href="{{ route('alat-gym.index') }}" class="btn btn-link">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Table -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nama Alat</th>
                        <th>Merek</th>
                        <th>Kondisi</th>
                        <th>Tanggal Pembelian</th>
                        <th>Keterangan</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alat as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="stat-icon primary me-2" style="width: 36px; height: 36px; font-size: 0.875rem;">
                                    <i class="bi bi-bicycle"></i>
                                </div>
                                <span class="fw-semibold">{{ $item->nama }}</span>
                            </div>
                        </td>
                        <td>{{ $item->merek ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $item->kondisi_badge }}">
                                {{ $item->kondisi_label }}
                            </span>
                        </td>
                        <td>{{ $item->waktu_pembelian ? $item->waktu_pembelian->format('d/m/Y') : '-' }}</td>
                        <td>
                            <span class="text-truncate d-inline-block" style="max-width: 150px;">
                                {{ $item->keterangan ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('alat-gym.show', $item) }}" class="btn btn-sm btn-light" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('alat-gym.edit', $item) }}" class="btn btn-sm btn-light" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('alat-gym.destroy', $item) }}" method="POST" 
                                      class="d-inline" onsubmit="return confirm('Hapus alat ini?')">
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
                        <td colspan="6" class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 2rem; opacity: 0.5;"></i>
                            <p class="text-muted mt-2 mb-0">Tidak ada data alat gym</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($alat->hasPages())
    <div class="card-footer bg-white">
        {{ $alat->links() }}
    </div>
    @endif
</div>
@endsection
