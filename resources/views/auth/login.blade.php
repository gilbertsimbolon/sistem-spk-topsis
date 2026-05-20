@extends('layouts.app')

@section('title', 'Login | SIK')

@php
    $hideLayout = true;
@endphp

@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Login -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                                <img src="{{ asset('img/logo-unima.svg') }}" alt="Logo" style="width: 40px; height: 40px;"
                                    class="d-none" />

                                <span class="app-brand-text demo text-heading fw-bold mb-2">Login</span>
                            </a>

                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Selamat Datang!👋</h4>
                        <p class="mb-6">Silahkan login terlebih dahulu untuk menikmati fitur.</p>

                        <form id="formAuthentication" method="POST" class="mb-6" action="{{ route('login.store') }}">
                            @csrf
                            <div class="mb-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email or username" autofocus />
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i
                                            class="icon-base bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-8">
                                <div class="d-flex justify-content-between">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" id="remember-me" />
                                        <label class="form-check-label" for="remember-me"> Ingat saya </label>
                                    </div>
                                    <a href="auth-forgot-password-basic.html">
                                        <span>Lupa password?</span>
                                    </a>
                                </div>
                            </div>
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>Belum punya akun?</span>
                            <a href="{{ route('register') }}">
                                <span>Registrasi</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>
@endsection
