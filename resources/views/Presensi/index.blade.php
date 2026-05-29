@extends('layouts.app')

@section('title', 'Presensi')

@section('content')
    <div class="page-header d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Presensi</h1>
            <p class="page-subtitle">Kelola presensi anggota gym melalui QR Code</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scanQrModal" id="btnOpenScanner">
                <i class="bi bi-qr-code-scan me-2"></i> Scan QR Presensi
            </button>
        </div>
    </div>

    <!-- Scan QR Modal -->
    <div class="modal fade" id="scanQrModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-qr-code-scan me-2"></i>Scan QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="btnCloseScanner"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="reader" width="600px"></div>
                    
                    <div class="my-3 text-muted small text-uppercase">-- Atau Masukkan Manual --</div>
                    <div class="input-group mb-3">
                        <input type="text" id="manualQrInput" class="form-control" placeholder="Contoh: TRX-15">
                        <button class="btn btn-primary" type="button" id="btnManualSubmit">Proses</button>
                    </div>

                    <div id="scanResult" class="alert d-none mt-3"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
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
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama anggota...">
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
    <div class="row g-4 mb-4 justify-content-center">
        <div class="col-md-12">
            <div class="stat-card justify-content-center">
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
                            <th>Paket</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($presensi as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 36px; height: 36px; font-size: 0.8rem;">
                                            {{ $item->transaksi->anggota->initials }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $item->transaksi->anggota->nama }}</div>
                                            <small class="text-muted">{{ $item->transaksi->anggota->no_telp }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $item->transaksi->paket->nama_paket }}<br>
                                    <small class="text-muted">TRX-{{ $item->transaksi->id }}</small>
                                </td>
                                <td>{{ $item->tanggal }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="bi bi-clock me-1"></i> {{ $item->jam }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('presensi.show', $item) }}" class="btn btn-sm btn-light"
                                            title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form action="{{ route('presensi.destroy', $item) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Hapus presensi ini?')">
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
            <div class="card-footer pagination-compact">
                {{ $presensi->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        let html5QrcodeScanner;

        function onScanSuccess(decodedText, decodedResult) {
            // Stop scanner instantly to prevent multiple scans
            html5QrcodeScanner.clear();

            const resultDiv = document.getElementById('scanResult');
            resultDiv.className = 'alert alert-info';
            resultDiv.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Memproses...';
            resultDiv.classList.remove('d-none');

            fetch('{{ route("presensi.scan") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ qr_code: decodedText })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    resultDiv.className = 'alert alert-success';
                    resultDiv.innerHTML = '<i class="bi bi-check-circle me-2"></i>' + data.message +
                        '<br><strong>' + data.data.nama + '</strong> (' + data.data.paket + ')<br>Jam: ' + data.data.waktu;
                    setTimeout(() => location.reload(), 2000);
                } else {
                    resultDiv.className = 'alert alert-danger';
                    resultDiv.innerHTML = '<i class="bi bi-exclamation-triangle me-2"></i>' + data.message;
                    
                    // Allow rescanning after 3 seconds on fail
                    setTimeout(() => {
                        resultDiv.classList.add('d-none');
                        startScanner();
                    }, 3000);
                }
            })
            .catch(error => {
                resultDiv.className = 'alert alert-danger';
                resultDiv.textContent = 'Terjadi kesalahan sistem saat menghubungi server.';
                
                setTimeout(() => {
                    resultDiv.classList.add('d-none');
                    startScanner();
                }, 3000);
            });
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning
            // console.warn(`Code scan error = ${error}`);
        }

        function startScanner() {
            html5QrcodeScanner = new Html5QrcodeScanner(
                "reader",
                { fps: 10, qrbox: {width: 250, height: 250} },
                /* verbose= */ false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        }

        // Handle modal events to start/stop scanner
        const modal = document.getElementById('scanQrModal');
        modal.addEventListener('shown.bs.modal', function () {
            startScanner();
        });

        modal.addEventListener('hidden.bs.modal', function () {
            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear();
            }
            document.getElementById('scanResult').classList.add('d-none');
            document.getElementById('manualQrInput').value = '';
        });

        document.getElementById('btnManualSubmit').addEventListener('click', function() {
            const val = document.getElementById('manualQrInput').value;
            if (val.trim() === '') return;
            
            if (html5QrcodeScanner) {
                try {
                    html5QrcodeScanner.clear();
                } catch(e) {}
            }
            onScanSuccess(val, null);
        });
    </script>
@endpush