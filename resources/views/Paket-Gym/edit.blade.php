@extends('layouts.app')

@section('title', 'Edit Paket Gym')

@section('content')
<div class="page-header">
    <div class="d-flex align-items-center mb-2">
        <a href="{{ route('paket-gym.index') }}" class="btn btn-light btn-sm me-2">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="page-title mb-0">Edit Paket Gym</h1>
    </div>
    <p class="page-subtitle">Perbarui data paket membership</p>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('paket-gym.update', $paketGym) }}">
            @csrf @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama_paket" class="form-label">Nama Paket <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_paket') is-invalid @enderror" 
                           id="nama_paket" name="nama_paket" value="{{ old('nama_paket', $paketGym->nama_paket) }}">
                    @error('nama_paket')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                    <label for="durasi_hari" class="form-label">Durasi (Hari) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('durasi_hari') is-invalid @enderror" 
                           id="durasi_hari" name="durasi_hari" value="{{ old('durasi_hari', $paketGym->durasi_hari) }}" min="1">
                    @error('durasi_hari')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                    <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                           id="harga" name="harga" value="{{ old('harga', $paketGym->harga) }}" min="0">
                    @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                          id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $paketGym->deskripsi) }}</textarea>
                @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('paket-gym.index') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection