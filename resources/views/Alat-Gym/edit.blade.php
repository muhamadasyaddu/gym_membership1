@extends('layouts.app')

@section('title', 'Edit Alat Gym')

@section('content')
<div class="page-header">
    <div class="d-flex align-items-center mb-2">
        <a href="{{ route('alat-gym.index') }}" class="btn btn-light btn-sm me-2">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="page-title mb-0">Edit Alat Gym</h1>
    </div>
    <p class="page-subtitle">Perbarui data alat</p>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST"action="{{ route('alat-gym.update',$alatGym) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label">Nama Alat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                           id="nama" name="nama" value="{{ old('nama', $alatGym->nama) }}">
                    @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="merek" class="form-label">Merek</label>
                    <input type="text" class="form-control @error('merek') is-invalid @enderror" 
                           id="merek" name="merek" value="{{ old('merek', $alatGym->merek) }}">
                    @error('merek')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kondisi" class="form-label">Kondisi <span class="text-danger">*</span></label>
                    <select class="form-select @error('kondisi') is-invalid @enderror" 
                            id="kondisi" name="kondisi">
                        <option value="baik" {{ old('kondisi', $alatGym->kondisi) == 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak_ringan" {{ old('kondisi', $alatGym->kondisi) == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="rusak_berat" {{ old('kondisi', $alatGym->kondisi) == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                    @error('kondisi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="waktu_pembelian" class="form-label">Tanggal Pembelian</label>
                    <input type="date" class="form-control @error('waktu_pembelian') is-invalid @enderror" 
                           id="waktu_pembelian" name="waktu_pembelian" 
                           value="{{ old('waktu_pembelian', $alatGym->waktu_pembelian?->format('Y-m-d')) }}">
                    @error('waktu_pembelian')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                          id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $alatGym->keterangan) }}</textarea>
                @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">

                <label class="form-label">
                    Gambar Alat
                </label>

                @if($alatGym->gambar)
                    <div class="mb-2">
                        <img
                            src="{{ asset('storage/'.$alatGym->gambar) }}"
                            class="img-thumbnail"
                            style="
                            width:180px;
                            height:140px;

                            object-fit:contain;

                            padding:12px;

                            background:#ffffff;

                            border:1px solid #e5e7eb;

                            border-radius:16px;

                            box-shadow:0 4px 12px rgba(0,0,0,.05);
                            ">
                    </div>
                @endif

                <input
                    type="file"
                    
                    name="gambar"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp">

            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('alat-gym.index') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection