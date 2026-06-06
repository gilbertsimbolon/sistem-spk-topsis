@extends('layouts.app')

@section('title', 'Register | SIK')

@php
    $hideLayout = true;
@endphp

@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                                <span class="app-brand-text demo text-heading fw-bold mb-2">Registrasi</span>
                            </a>
                        </div>
                        <h4 class="mb-1">Mulai pengalaman Anda 🚀</h4>
                        <p class="mb-6">Mencari kost menjadi mudah!</p>

                        <form method="POST" action="{{ route('register.create') }}">
                            @csrf

                            {{-- Nama Lengkap --}}
                            <div class="mb-2">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                    value="{{ old('name') }}" placeholder="Masukkan nama lengkap anda" autofocus />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Fakultas --}}
                            <div class="mb-2">
                                <label for="fakultas" class="form-label">Fakultas</label>
                                <select class="form-select @error('fakultas') is-invalid @enderror" name="fakultas">
                                    <option value="fatek" {{ old('fakultas') == 'fatek' ? 'selected' : '' }}>Fakultas Teknik</option>
                                    <option value="feb" {{ old('fakultas') == 'feb' ? 'selected' : '' }}>Fakultas Ekonomi & Bisnis</option>
                                    <option value="fbs" {{ old('fakultas') == 'fbs' ? 'selected' : '' }}>Fakultas Bahasa & Seni</option>
                                    <option value="fish" {{ old('fakultas') == 'fish' ? 'selected' : '' }}>Fakultas Ilmu Sosial & Hukum</option>
                                    <option value="fikkm" {{ old('fakultas') == 'fikkm' ? 'selected' : '' }}>Fakultas Ilmu Keolahragaan & Kesehatan Masyarakat</option>
                                    <option value="fke" {{ old('fakultas') == 'fke' ? 'selected' : '' }}>Fakultas Kedokteran</option>
                                    <option value="fipp" {{ old('fakultas') == 'fipp' ? 'selected' : '' }}>Fakultas Ilmu Pendidikan</option>
                                </select>
                                @error('fakultas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="Masukkan email anda" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="form-password-toggle mb-2">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="············" />
                                    <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary d-grid w-100 mb-3">Daftar</button>
                        </form>

                        <p class="text-center">
                            <span>Sudah punya akun?</span>
                            <a href="{{ route('login') }}">
                                <span>Login</span>
                            </a>
                        </p>
                    </div>
                </div>
                </div>
        </div>
    </div>
@endsection
