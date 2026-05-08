@extends('layouts.app')

@section('title', 'Detail User')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
<li class="breadcrumb-item active" aria-current="page">Detail</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 fw-bold" style="color: var(--primary-color);">
                    <i class="bi bi-person me-2"></i>Detail User
                </h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center text-white mb-3" 
                         style="width: 80px; height: 80px; font-size: 2rem;">
                        {{ strtoupper(substr($user->nama, 0, 1)) }}
                    </div>
                    <h4 class="mb-1">{{ $user->nama }}</h4>
                    <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }} fs-6">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>

                <hr>

                <table class="table table-borderless">
                    <tr>
                        <td width="140" class="text-muted">Nama</td>
                        <td class="fw-bold">{{ $user->nama }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email</td>
                        <td class="fw-bold">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Role</td>
                        <td>
                            <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Dibuat</td>
                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Diperbarui</td>
                        <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>

                <hr>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    @if($user->id !== auth()->id())
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" id="delete-form" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete('delete-form')" 
                                class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection