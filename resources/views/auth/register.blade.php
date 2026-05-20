@extends('layouts.app')

@section('title', 'Register | SIK')

@php
    $hideLayout = true;
@endphp

@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                                <img src="{{ asset('img/logo-unima.svg') }}" alt="Logo" style="width: 40px; height: 40px;"
                                    class="d-none" />

                                <span class="app-brand-text demo text-heading fw-bold mb-2">Registrasi</span>
                            </a>

                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Mulai pengalaman Anda 🚀</h4>
                        <p class="mb-6">Mencari kost menjadi mudah!</p>

                        <form method="POST" action="{{ route('register.create') }}">
                            @csrf
                            {{-- First Name --}}
                            <div class="mb-2">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan nama lengkap anda" autofocus />
                            </div>

                            {{-- Fakultas --}}
                            <div class="mb-2">
                                <label for="fakultas" class="form-label">Fakultas</label>
                                <select class="form-select mb-3" aria-label=".form-select-lg example" name="fakultas">
                                    <option value="fatek">Fakultas Teknik</option>
                                    <option value="feb">Fakultas Ekonomi & Bisnis</option>
                                    <option value="fbs">Fakultas Bahasa & Seni</option>
                                    <option value="fish">Fakultas Ilmu Sosial & Hukum</option>
                                    <option value="fikkm">Fakultas Ilmu Keolahragaan & Kesehatan Masyarakat</option>
                                    <option value="fke">Fakultas Kedokteran</option>
                                    <option value="fipp">Fakultas Ilmu Pendidikan</option>
                                </select>
                            </div>

                            {{-- Email --}}
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" />
                            </div>

                            {{-- Password --}}
                            <div class="form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i
                                            class="icon-base bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="my-7">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                                    <label class="form-check-label" for="terms-conditions">
                                        Saya menyetujui
                                        <a href="javascript:void(0);">syarat & ketentuan</a>
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100">Daftar</button>
                        </form>

                        <p class="text-center">
                            <span>Sudah punya akun?</span>
                            <a href="{{ route('login') }}">
                                <span>Login</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>
@endsection
