@extends('layouts.app')

@section('title', 'Edit Presensi')

@section('content')
<div class="page-header">
    <div class="d-flex align-items-center mb-2">
        <a href="{{ route('presensi.index') }}" class="btn btn-light btn-sm me-2">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="page-title mb-0">Edit Presensi</h1>
    </div>
    <p class="page-subtitle">Perbarui data presensi</p>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('presensi.update', $presensi) }}">
            @csrf @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="anggota_id" class="form-label">Anggota <span class="text-danger">*</span></label>
                    <select class="form-select @error('anggota_id') is-invalid @enderror" 
                            id="anggota_id" name="anggota_id" required>
                        <option value="">Pilih anggota</option>
                        @foreach($anggota as $a)
                        <option value="{{ $a->id }}" {{ old('anggota_id', $presensi->anggota_id) == $a->id ? 'selected' : '' }}>
                            {{ $a->nama }} ({{ $a->status_label }})
                        </option>
                        @endforeach
                    </select>
                    @error('anggota_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
                    <input type="datetime-local" class="form-control @error('waktu_masuk') is-invalid @enderror" 
                           id="waktu_masuk" name="waktu_masuk" 
                           value="{{ old('waktu_masuk', $presensi->waktu_masuk->format('Y-m-d\TH:i')) }}">
                    @error('waktu_masuk')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('presensi.index') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection