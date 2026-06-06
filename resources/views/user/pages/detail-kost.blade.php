@extends('layouts.app')

@section('title', 'Detail Kost | ' . $kost->nama_kost)

@section('content')
<div class="container py-5">

    {{-- BREADCRUMB / KEMBALI --}}
    <div class="mb-4">
        <a href="{{ route('dashboard.index') }}" class="text-decoration-none text-muted small">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="row g-4">
        {{-- AREA FOTO (KIRI) --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm overflow-hidden mb-4">
                <div class="card-body p-3">
                    <h3 class="fw-bold text-dark mb-3">{{ $kost->nama_kost }}</h3>

                    {{-- SLIDER CAROUSEL BOOTSTRAP --}}
                    @if ($kost->foto->count())
                        <div id="kostUserCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                            <div class="carousel-inner rounded overflow-hidden shadow-sm">
                                @foreach ($kost->foto as $key => $foto)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $foto->foto) }}" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="Foto Kost">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#kostUserCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#kostUserCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        </div>

                        {{-- THUMBNAIL BAWAH --}}
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($kost->foto as $key => $foto)
                                <button type="button" data-bs-target="#kostUserCarousel" data-bs-slide-to="{{ $key }}" class="border-0 bg-transparent p-0">
                                    <img src="{{ asset('storage/' . $foto->foto) }}" class="rounded border" style="width: 90px; height: 65px; object-fit: cover; cursor: pointer;">
                                </button>
                            @endforeach
                        </div>
                    @else
                        {{-- GAMBAR DEFAULT JIKA TIDAK ADA FOTO --}}
                        <img src="{{ asset('template/paneladmin/assets/img/background/1.jpg') }}" class="img-fluid rounded w-100 shadow-sm" style="height: 450px; object-fit: cover;" alt="Default Image">
                    @endif
                </div>
            </div>
        </div>

        {{-- AREA DETAIL INFORMASI (KANAN) --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm border-top border-primary border-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-4">Informasi Sewa</h5>

                    <div class="mb-4">
                        <small class="text-muted d-block mb-1">Harga Sewa</small>
                        <h3 class="fw-bold text-primary mb-0">
                            Rp {{ number_format($kost->harga, 0, ',', '.') }}<span class="fs-6 fw-normal text-muted"> / bulan</span>
                        </h3>
                    </div>

                    <div class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                        <span class="text-muted small">Jenis Kost</span>
                        <span class="badge bg-primary px-2.5 py-1.5 shadow-sm">
                            {{ $kost->jenis->jenis_kost ?? 'Campur' }}
                        </span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                        <span class="text-muted small">Daerah</span>
                        <span class="fw-semibold text-dark small">{{ $kost->daerah->name ?? 'Tidak Ada' }}</span>
                    </div>

                    <div class="mb-4">
                        <small class="text-muted d-block mb-1">Alamat Lengkap</small>
                        <p class="text-dark small mb-0"><i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $kost->alamat }}</p>
                    </div>

                    {{-- TOMBOL INTERAKSI UTAMA USER --}}
                    @if($kost->owner && $kost->owner->nomor)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kost->owner->nomor) }}?text=Halo,%20saya%20tertarik%20dengan%20Kost%20{{ urlencode($kost->nama_kost) }}%20yang%20ada%20di%20SIPKOST."
                           target="_blank"
                           class="btn btn-success w-100 py-2.5 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-whatsapp fs-5"></i> Hubungi Pemilik Kost
                        </a>
                    @else
                        <button class="btn btn-secondary w-100 py-2.5 fw-bold" disabled>
                            <i class="bi bi-telephone-x me-2"></i> Kontak Tidak Tersedia
                        </button>
                    @endif
                </div>
            </div>

            {{-- DETAIL SPESIFIKASI FASILITAS & KRITERIA --}}
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-3">Fasilitas & Layanan</h5>

                    <div class="mb-3">
                        <small class="text-muted d-block mb-2 fw-semibold">Fasilitas Kamar/Bersama</small>
                        @forelse ($kost->fasilitas as $f)
                            <span class="badge bg-light text-dark border mb-1 me-1 px-3 py-2 small">{{ $f->keterangan }}</span>
                        @empty
                            <span class="text-muted small d-block italic">Tidak ada fasilitas terdaftar</span>
                        @endforelse
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block mb-2 fw-semibold">Sistem Keamanan</small>
                        @forelse ($kost->keamanan as $km)
                            <span class="badge bg-light text-dark border mb-1 me-1 px-3 py-2 small">{{ $km->keterangan }}</span>
                        @empty
                            <span class="text-muted small d-block italic">Tidak ada info keamanan</span>
                        @endforelse
                    </div>

                    <div>
                        <small class="text-muted d-block mb-2 fw-semibold">Kebersihan</small>
                        @forelse ($kost->kebersihan as $kb)
                            <span class="badge bg-light text-dark border mb-1 me-1 px-3 py-2 small">{{ $kb->keterangan }}</span>
                        @empty
                            <span class="text-muted small d-block italic">Tidak ada info kebersihan</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
