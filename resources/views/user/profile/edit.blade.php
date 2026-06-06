@extends('layouts.app')

@section('title', 'My Profile | SIPKOS')

@section('content')
<div class="container py-5">

    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold text-dark mb-1">My Profile</h4>
            <p class="text-muted small">Kelola informasi data diri dan keamanan kata sandi akun Anda.</p>
        </div>
    </div>

    {{-- ALERT PESAN SUKSES --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- CARD UBAH DATA PROFIL --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-4"><i class="bi bi-person-card-text text-primary me-2"></i>Informasi Profil</h5>

                    <form action="{{ route('profile.user.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold text-secondary">Nama Lengkap</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                                name="name" value="{{ old('name', Auth::user()->name) }}" required autofocus />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-secondary">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" id="email"
                                name="email" value="{{ old('email', Auth::user()->email) }}" required />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Role</label>
                            <input class="form-control text-capitalize bg-light" type="text" value="{{ Auth::user()->role }}"
                                disabled />
                            <small class="text-muted d-block mt-1" style="font-size: 11px;">
                                <i class="bi bi-info-circle me-1"></i>Kategori hak akses Anda di dalam sistem.
                            </small>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary px-4 fw-semibold shadow-sm">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- CARD UBAH PASSWORD --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-4"><i class="bi bi-shield-lock text-warning me-2"></i>Ubah Password</h5>

                    <form action="{{ route('profile.user.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-semibold text-secondary">Password Saat Ini</label>
                            <input class="form-control @error('current_password') is-invalid @enderror" type="password"
                                id="current_password" name="current_password"
                                placeholder="············"
                                required />
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-secondary">Password Baru</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                id="password" name="password"
                                placeholder="············"
                                required />
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold text-secondary">Konfirmasi Password Baru</label>
                            <input class="form-control" type="password" id="password_confirmation"
                                name="password_confirmation"
                                placeholder="············"
                                required />
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-warning px-4 fw-semibold shadow-sm text-dark">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
