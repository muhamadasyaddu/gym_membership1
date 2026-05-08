@extends('layouts.app')

@section('title', 'Detail Anggota')

@section('content')
<div class="page-header">
    <div class="d-flex align-items-center mb-2">
        <a href="{{ route('anggota.index') }}" class="btn btn-light btn-sm me-2">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="page-title mb-0">Detail Anggota</h1>
    </div>
    <p class="page-subtitle">Informasi lengkap anggota</p>
</div>

<div class="row g-4">
    <!-- Profile Card -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-body text-center py-4">
                <div class="user-avatar mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                    {{ $anggota->initials }}
                </div>
                <h4 class="mb-1">{{ $anggota->nama }}</h4>
                <p class="text-muted mb-2">{{ $anggota->email ?? '-' }}</p>
                <span class="badge bg-{{ $anggota->status_badge }} mb-3">
                    {{ $anggota->status_label }}
                </span>
                
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('anggota.edit', $anggota) }}" class="btn btn-light btn-sm">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    @if($anggota->status == 'tidak_aktif')
                    <a href="{{ route('transaksi.create') }}?anggota={{ $anggota->id }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus me-1"></i> Daftar Paket
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Info Card -->
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header">Informasi Anggota</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted mb-1">ID Anggota</label>
                        <p class="fw-semibold mb-0">#{{ $anggota->id }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted mb-1">Nomor Telepon</label>
                        <p class="fw-semibold mb-0">{{ $anggota->no_telp }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted mb-1">Jenis Kelamin</label>
                        <p class="fw-semibold mb-0">{{ $anggota->jenis_kelamin_label }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted mb-1">Tanggal Daftar</label>
                        <p class="fw-semibold mb-0">{{ $anggota->tanggal_daftar->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label text-muted mb-1">Alamat</label>
                        <p class="fw-semibold mb-0">{{ $anggota->alamat ?? '-' }}</p>
                    </div>
                </div>
                
                @if($anggota->membership_aktif)
                <div class="bg-light rounded p-3 mt-2">
                    <h6 class="mb-2"><i class="bi bi-patch-check-fill text-success me-2"></i>Membership Aktif</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-muted">Paket</small>
                            <p class="mb-1 fw-semibold">{{ $anggota->membership_aktif->paket->nama_paket }}</p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Berakhir</small>
                            <p class="mb-1 fw-semibold">{{ $anggota->membership_aktif->waktu_berakhir->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Sisa Waktu</small>
                            @php
                            $sisa = now()->diffInDays($anggota->membership_aktif->waktu_berakhir, false);
                            @endphp
                            <p class="mb-1 fw-semibold {{ $sisa <= 7 ? 'text-danger' : 'text-success' }}">
                                {{ $sisa > 0 ? $sisa . ' hari' : 'Hari ini' }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <!-- Transaction History -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Riwayat Transaksi</span>
                <a href="{{ route('transaksi.create') }}?anggota={{ $anggota->id }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i> Baru
                </a>
            </div>
            <div class="card-body p-0">
                @if($anggota->transaksi->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Paket</th>
                                <th>Total</th>
                                <th>Berakhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anggota->transaksi->take(5) as $t)
                            <tr>
                                <td>{{ $t->paket->nama_paket }}</td>
                                <td>{{ $t->formatted_total }}</td>
                                <td>
                                    {{ $t->waktu_berakhir->format('d/m/Y') }}
                                    @if($t->isMembershipActive())
                                    <span class="badge bg-success ms-1">Aktif</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-receipt" style="font-size: 1.5rem;"></i>
                    <p class="mt-2 mb-0">Belum ada transaksi</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Attendance History -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Riwayat Presensi</span>
                <a href="{{ route('presensi.create') }}?anggota={{ $anggota->id }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i> Baru
                </a>
            </div>
            <div class="card-body p-0">
                @if($anggota->presensi->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anggota->presensi->take(10) as $p)
            <tr>
                                <td>{{ $p->tanggal }}</td>
                                <td>{{ $p->jam }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-calendar-check" style="font-size: 1.5rem;"></i>
                    <p class="mt-2 mb-0">Belum ada presensi</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection