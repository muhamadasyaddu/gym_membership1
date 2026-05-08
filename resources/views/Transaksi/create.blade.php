@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="page-header">
    <div class="d-flex align-items-center mb-2">
        <a href="{{ route('transaksi.index') }}" class="btn btn-light btn-sm me-2">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="page-title mb-0">Tambah Transaksi</h1>
    </div>
    <p class="page-subtitle">Buat transaksi membership baru</p>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('transaksi.store') }}">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="anggota_id" class="form-label">Anggota <span class="text-danger">*</span></label>
                    <select class="form-select @error('anggota_id') is-invalid @enderror" 
                            id="anggota_id" name="anggota_id" required>
                        <option value="">Pilih anggota</option>
                        @foreach($anggota as $a)
                        <option value="{{ $a->id }}" {{ old('anggota_id', request('anggota')) == $a->id ? 'selected' : '' }}>
                            {{ $a->nama }} ({{ $a->status_label }})
                        </option>
                        @endforeach
                    </select>
                    @error('anggota_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="paket_id" class="form-label">Paket Gym <span class="text-danger">*</span></label>
                    <select class="form-select @error('paket_id') is-invalid @enderror" 
                            id="paket_id" name="paket_id" required>
                        <option value="">Pilih paket</option>
                        @foreach($paket as $p)
                        <option value="{{ $p->id }}" 
                                data-durasi="{{ $p->durasi_hari }}" 
                                data-harga="{{ $p->harga }}"
                                data-nama="{{ $p->nama_paket }}"
                                {{ old('paket_id', request('paket')) == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_paket }} - {{ $p->formatted_harga }} ({{ $p->durasi_label }})
                        </option>
                        @endforeach
                    </select>
                    @error('paket_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="waktu_mulai" class="form-label">Waktu Mulai <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('waktu_mulai') is-invalid @enderror" 
                           id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai', date('Y-m-d')) }}">
                    @error('waktu_mulai')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Waktu Berakhir</label>
                    <input type="text" class="form-control" id="waktu_berakhir_display" readonly 
                           placeholder="Otomatis terhitung dari paket">
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Total Harga</label>
                    <input type="text" class="form-control fw-bold" id="total_harga_display" readonly 
                           placeholder="Otomatis dari paket">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="payment_method" class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                    <select class="form-select @error('payment_method') is-invalid @enderror" 
                            id="payment_method" name="payment_method">
                        <option value="tunai" {{ old('payment_method') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                        <option value="e-wallet" {{ old('payment_method') == 'e-wallet' ? 'selected' : '' }}>E-Wallet</option>
                    </select>
                    @error('payment_method')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label">Status Pembayaran</label>
                    <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" name="status">
                        <option value="lunas" {{ old('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                          id="keterangan" name="keterangan" rows="2" placeholder="Catatan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Catatan:</strong> Status anggota akan otomatis berubah menjadi <strong>Aktif</strong> setelah transaksi disimpan.
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Simpan Transaksi
                </button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-calculate waktu berakhir and total harga
    document.getElementById('paket_id').addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        const durasi = option.dataset.durasi;
        const harga = option.dataset.harga;
        
        if (durasi && harga) {
            // Calculate end date
            const mulaiInput = document.getElementById('waktu_mulai');
            const mulaiDate = new Date(mulaiInput.value);
            const berakhirDate = new Date(mulaiDate);
            berakhirDate.setDate(berakhirDate.getDate() + parseInt(durasi));
            
            document.getElementById('waktu_berakhir_display').value = berakhirDate.toLocaleDateString('id-ID');
            document.getElementById('total_harga_display').value = 'Rp ' + parseInt(harga).toLocaleString('id-ID');
        }
    });
    
    document.getElementById('waktu_mulai').addEventListener('change', function() {
        document.getElementById('paket_id').dispatchEvent(new Event('change'));
    });
    
    // Initial calculation if paket is pre-selected
    if (document.getElementById('paket_id').value) {
        document.getElementById('paket_id').dispatchEvent(new Event('change'));
    }
</script>
@endpush
