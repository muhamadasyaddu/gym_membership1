@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div>
        <h1 class="page-title">Transaksi</h1>
        <p class="page-subtitle">Kelola transaksi membership</p>
    </div>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i> Tambah Transaksi
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
                           value="{{ request('search') }}" placeholder="Cari nama anggota...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="status">
                    <option value="">Semua Status</option>
                    <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-light">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-link">Reset</a>
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
                        <th>Kode</th>
                        <th>Anggota</th>
                        <th>Paket</th>
                        <th>Periode</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $item)
                    <tr>
                        <td>
                            <span class="fw-semibold">#TR{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-2" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                    {{ $item->anggota->initials }}
                                </div>
                                {{ $item->anggota->nama }}
                            </div>
                        </td>
                        <td>{{ $item->paket->nama_paket }}</td>
                        <td>
                            <small>
                                {{ $item->waktu_mulai->format('d/m/Y') }} - <br>
                                {{ $item->waktu_berakhir->format('d/m/Y') }}
                            </small>
                        </td>
                        <td class="fw-semibold">{{ $item->formatted_total }}</td>
                        <td>{{ $item->payment_method_label }}</td>
                        <td>
                            <span class="badge bg-{{ $item->status_badge }}">
                                {{ $item->status_label }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('transaksi.show', $item) }}" class="btn btn-sm btn-light" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('transaksi.edit', $item) }}" class="btn btn-sm btn-light" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('transaksi.destroy', $item) }}" method="POST" 
                                      class="d-inline" onsubmit="return confirm('Hapus transaksi ini?')">
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
                        <td colspan="8" class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 2rem; opacity: 0.5;"></i>
                            <p class="text-muted mt-2 mb-0">Tidak ada data transaksi</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($transaksi->hasPages())
    <div class="card-footer bg-white">
        {{ $transaksi->links() }}
    </div>
    @endif
</div>
@endsection