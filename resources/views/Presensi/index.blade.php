@extends('layouts.app')

@section('title', 'Presensi')

@section('content')
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div>
        <h1 class="page-title">Presensi</h1>
        <p class="page-subtitle">Kelola presensi anggota gym</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#quickPresensiModal">
            <i class="bi bi-lightning-charge me-2"></i> Quick Presensi
        </button>
        <a href="{{ route('presensi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i> Tambah Presensi
        </a>
    </div>
</div>

<!-- Quick Presensi Modal -->
<div class="modal fade" id="quickPresensiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-lightning-charge me-2"></i>Quick Presensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="quick_anggota" class="form-label">Pilih Anggota Aktif</label>
                    <select class="form-select" id="quick_anggota">
                        <option value="">-- Pilih Anggota --</option>
                        @php
                        $anggotaAktif = \App\Models\Anggota::where('status', 'aktif')->orderBy('nama')->get();
                        @endphp
                        @foreach($anggotaAktif as $a)
                        <option value="{{ $a->id }}">{{ $a->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="quickResult" class="alert d-none"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnQuickPresensi">
                    <i class="bi bi-check-lg me-1"></i> Catat Presensi
                </button>
            </div>
        </div>
    </div>
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
                <input type="date" class="form-control" name="tanggal" value="{{ request('tanggal') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-light">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                <a href="{{ route('presensi.index') }}" class="btn btn-link">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Today Stats -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon success">
                <i class="bi bi-calendar-check-fill"></i>
            </div>
            <div>
                <div class="stat-value">{{ \App\Models\Presensi::whereDate('waktu_masuk', today())->count() }}</div>
                <div class="stat-label">Presensi Hari Ini</div>
            </div>
        </div>
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
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Status Member</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($presensi as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-2" style="width: 36px; height: 36px; font-size: 0.8rem;">
                                    {{ $item->anggota->initials }}
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ $item->anggota->nama }}</div>
                                    <small class="text-muted">{{ $item->anggota->no_telp }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $item->tanggal }}</td>
                        <td>
                            <span class="badge bg-success">
                                <i class="bi bi-clock me-1"></i> {{ $item->jam }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $item->anggota->status_badge }}">
                                {{ $item->anggota->status_label }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('presensi.show', $item) }}" class="btn btn-sm btn-light" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('presensi.destroy', $item) }}" method="POST" 
                                      class="d-inline" onsubmit="return confirm('Hapus presensi ini?')">
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
                            <p class="text-muted mt-2 mb-0">Tidak ada data presensi</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($presensi->hasPages())
    <div class="card-footer bg-white">
        {{ $presensi->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('btnQuickPresensi').addEventListener('click', function() {
        const anggotaId = document.getElementById('quick_anggota').value;
        const resultDiv = document.getElementById('quickResult');
        
        if (!anggotaId) {
            resultDiv.className = 'alert alert-danger';
            resultDiv.textContent = 'Pilih anggota terlebih dahulu!';
            resultDiv.classList.remove('d-none');
            return;
        }
        
        fetch('{{ route("presensi.quick") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ anggota_id: anggotaId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                resultDiv.className = 'alert alert-success';
                resultDiv.innerHTML = '<i class="bi bi-check-circle me-2"></i>' + data.message + 
                    '<br><small>' + data.data.nama + ' - ' + data.data.waktu + '</small>';
                setTimeout(() => location.reload(), 1500);
            } else {
                resultDiv.className = 'alert alert-danger';
                resultDiv.innerHTML = '<i class="bi bi-exclamation-triangle me-2"></i>' + data.message;
            }
            resultDiv.classList.remove('d-none');
        })
        .catch(error => {
            resultDiv.className = 'alert alert-danger';
            resultDiv.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
            resultDiv.classList.remove('d-none');
        });
    });
</script>
@endpush