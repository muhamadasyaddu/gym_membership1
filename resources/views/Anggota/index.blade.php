@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div>
        <h1 class="page-title">Data Anggota</h1>
        <p class="page-subtitle">Kelola data anggota gym</p>
    </div>
    <a href="{{ route('anggota.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i> Tambah Anggota
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
                           value="{{ request('search') }}" placeholder="Cari nama atau telepon...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="status">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-light">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                <a href="{{ route('anggota.index') }}" class="btn btn-link">Reset</a>
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
                        <th>Anggota</th>
                        <th>No. Telepon</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggota as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-2" style="width: 36px; height: 36px; font-size: 0.8rem;">
                                    {{ $item->initials }}
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ $item->nama }}</div>
                                    <small class="text-muted">ID: {{ $item->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $item->no_telp }}</td>
                        <td>
                            @if($item->jenis_kelamin == 'L')
                            <span class="badge bg-primary">
                                <i class="bi bi-gender-male me-1"></i> Laki-laki
                            </span>
                            @else
                            <span class="badge bg-pink" style="background: #ec4899;">
                                <i class="bi bi-gender-female me-1"></i> Perempuan
                            </span>
                            @endif
                        </td>
                        <td>{{ $item->tanggal_daftar->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $item->status_badge }}">
                                {{ $item->status_label }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('anggota.show', $item) }}" class="btn btn-sm btn-light" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('anggota.edit', $item) }}" class="btn btn-sm btn-light" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('anggota.destroy', $item) }}" method="POST" 
                                      class="d-inline" onsubmit="return confirm('Hapus anggota ini?')">
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
                            <p class="text-muted mt-2 mb-0">Tidak ada data anggota</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($anggota->hasPages())
    <div class="card-footer bg-white">
        {{ $anggota->links() }}
    </div>
    @endif
</div>
@endsection