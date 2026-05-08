@extends('layouts.app')

@section('title', 'Paket Gym')

@section('content')
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div>
        <h1 class="page-title">Paket Gym</h1>
        <p class="page-subtitle">Kelola paket membership gym</p>
    </div>
    <a href="{{ route('paket-gym.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i> Tambah Paket
    </a>
</div>

<!-- Search -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" name="search" 
                           value="{{ request('search') }}" placeholder="Cari nama paket...">
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-light">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                <a href="{{ route('paket-gym.index') }}" class="btn btn-link">Reset</a>
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
                        <th>Nama Paket</th>
                        <th>Durasi</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paket as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="stat-icon primary me-2" style="width: 36px; height: 36px; font-size: 0.875rem;">
                                    <i class="bi bi-box-fill"></i>
                                </div>
                                <span class="fw-semibold">{{ $item->nama_paket }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $item->durasi_label }}</span>
                        </td>
                        <td class="fw-semibold">{{ $item->formatted_harga }}</td>
                        <td>
                            <span class="text-truncate d-inline-block" style="max-width: 200px;">
                                {{ $item->deskripsi ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('paket-gym.show', $item) }}" class="btn btn-sm btn-light" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('paket-gym.edit', $item) }}" class="btn btn-sm btn-light" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('paket-gym.destroy', $item) }}" method="POST" 
                                      class="d-inline" onsubmit="return confirm('Hapus paket ini?')">
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
                        <td colspan="5" class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 2rem; opacity: 0.5;"></i>
                            <p class="text-muted mt-2 mb-0">Tidak ada data paket gym</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($paket->hasPages())
    <div class="card-footer bg-white">
        {{ $paket->links() }}
    </div>
    @endif
</div>
@endsection