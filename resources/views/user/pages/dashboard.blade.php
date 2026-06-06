@extends('layouts.app')

@section('title', 'Dashboard | Sistem Pemilihan Kost')

@section('content')
    @php
        $fakultas = [
            'fatek' => 'Teknik',
            'feb' => 'Ekonomi & Bisnis',
            'fbs' => 'Bahasa & Seni',
            'fish' => 'Sosial & Hukum',
            'fikkm' => 'Ilmu Keolahragaan & Kesehatan Masyarakat',
            'fke' => 'Kedokteran',
            'fipp' => 'Ilmu Pendidikan',
        ];
    @endphp

    {{-- Kustomisasi CSS Tambahan untuk Mempercantik Tampilan --}}
    <style>
        .kost-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .kost-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .kost-img {
            height: 180px;
            object-fit: cover;
        }

        .criteria-box {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            border: 1px solid #e9ecef;
            height: 100%;
        }
    </style>

    <div class="py-4" id="dashboard-kost-section">

        <div class="container mb-5">
            <div class="mb-4">
                <h4 class="fw-bold text-dark mb-1">Kost-Kost Terbaik</h4>
            </div>

            <div id="ajax-dashboard-kost">
                <div class="row g-4">
                    @foreach ($kosts as $kos)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            {{-- PERBAIKAN: Mengubah route('login') menjadi route ke halaman detail kost user --}}
                            <a href="{{ route('dashboard.kost.show', $kos->id) }}"
                                class="text-decoration-none text-dark d-block h-100">
                                <div class="card border-0 shadow-sm h-100 kost-card">
                                    <div class="position-relative">
                                        <img src="{{ $kos->foto->isNotEmpty() ? asset('storage/' . $kos->foto->first()->foto) : asset('template/paneladmin/assets/img/background/1.jpg') }}"
                                            class="card-img-top kost-img" alt="{{ $kos->nama_kost }}">
                                        <span
                                            class="badge bg-success position-absolute top-0 start-0 m-2 px-2.5 py-1.5 shadow-sm">
                                            {{ $kos->jenis->jenis_kost ?? 'Campur' }}
                                        </span>
                                    </div>
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <h6 class="fw-bold text-dark text-truncate mb-1" title="{{ $kos->nama_kost }}">
                                                {{ $kos->nama_kost }}</h6>
                                            <small class="text-muted d-block mb-2">
                                                <i
                                                    class="bi bi-geo-alt me-1"></i>{{ $kos->daerah->name ?? 'Tidak Ada Daerah' }}
                                            </small>
                                            <p class="text-secondary small text-truncate mb-3"
                                                title="{{ $kos->fasilitas->implode('keterangan', ' • ') }}">
                                                {{ $kos->fasilitas->isEmpty() ? 'Fasilitas Standar' : $kos->fasilitas->implode('keterangan', ' • ') }}
                                            </p>
                                        </div>
                                        <h6 class="text-primary fw-bold mb-0">Rp
                                            {{ number_format($kos->harga, 0, ',', '.') }}<span
                                                class="text-muted fw-normal small">/bln</span></h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- NAVIGASI PAGINATION --}}
                <div class="d-flex justify-content-center mt-5 pagination-ajax">
                    {{ $kosts->links() }}
                </div>
            </div>

            <div class="container mb-5">
                <div class="card border-0 shadow-sm border-start border-success border-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-search me-2"></i>Filter Pencarian</h5>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label small fw-semibold text-muted">Fakultas</label>
                                <select class="form-select">
                                    @foreach ($jenis ?? [] as $j)
                                        <option>{{ $j->jenis_kost }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-semibold text-muted">Daerah</label>
                                <select class="form-select">
                                    @foreach ($daerah ?? [] as $d)
                                        <option>{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-semibold text-muted">Tipe Kost</label>
                                <select class="form-select">
                                    <option>Campur</option>
                                    <option>Pria</option>
                                    <option>Wanita</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-semibold text-muted">Harga Min</label>
                                <input type="number" class="form-control" placeholder="Rp 300.000">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-semibold text-muted">Harga Maks</label>
                                <input type="number" class="form-control" placeholder="Rp 1.000.000">
                            </div>
                            <div class="col-12 text-end mt-3">
                                <button class="btn btn-success px-4"><i class="bi bi-funnel me-2"></i>Cari Kost</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mb-5">
                <div class="text-center mb-4">
                    <h4 class="fw-bold text-dark mb-2">Sistem Rekomendasi Pintar (TOPSIS)</h4>
                    <div class="d-flex justify-content-center">
                        <p class="text-muted fs-6 mb-0" style="max-width: 750px; text-align: center;">
                            Gunakan kecerdasan buatan metode <b>TOPSIS</b> untuk membandingkan puluhan alternatif secara
                            objektif.
                            Sistem akan menghitung bobot nilai dari kriteria pilihanmu untuk menghasilkan urutan kost paling
                            akurat dan ideal.
                        </p>
                    </div>
                    <button class="btn btn-success px-4 py-2 fw-semibold mt-3 shadow-sm" type="button"
                        data-bs-toggle="collapse" data-bs-target="#preferensiTopsis" aria-expanded="false">
                        <i class="bi bi-cpu me-2"></i>Coba Rekomendasi TOPSIS
                    </button>
                </div>

                <div class="collapse" id="preferensiTopsis">
                    <div class="card border-0 shadow-sm p-4 bg-white mx-auto" style="max-width: 950px;">
                        <h5 class="fw-bold text-center text-success mb-1">Atur Parameter Kriteria Pilihan Anda</h5>
                        <p class="text-muted small text-center mb-4">Sistem akan menyusun rekomendasi terbaik berdasarkan
                            skala prioritas bobot di bawah ini.</p>

                        <form>
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-dark">1. Batas Anggaran Bulanan</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i
                                                    class="bi bi-wallet2 text-muted"></i></span>
                                            <input type="text" id="harga" class="form-control"
                                                placeholder="Contoh: Rp 800.000">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label fw-bold text-dark">2. Radius Jarak Koordinat</label>
                                        <button type="button" class="btn btn-outline-primary w-100 py-2 fw-semibold"
                                            id="getLocation">
                                            <i class="bi bi-geo-alt-fill me-2"></i>Gunakan Posisi Saya Saat Ini (GPS)
                                        </button>
                                        <div class="mt-2 p-2 rounded border bg-light text-center text-muted small"
                                            id="locationResult">
                                            <i class="bi bi-info-circle me-1"></i>Titik koordinat belum disinkronkan.
                                        </div>
                                        <input type="hidden" name="lat" id="lat">
                                        <input type="hidden" name="lng" id="lng">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark mb-2">3. Fasilitas & Penunjang
                                        Keamanan</label>
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <div class="criteria-box">
                                                <small class="fw-bold text-success d-block mb-2"><i
                                                        class="bi bi-shield-check me-1"></i>Keamanan</small>
                                                <div class="row row-cols-2 g-2">
                                                    @foreach ($keamanan ?? [] as $k)
                                                        <div class="col">
                                                            <div class="form-check"><input class="form-check-input"
                                                                    type="checkbox" name="keamanan[]"
                                                                    value="{{ $k->id }}"
                                                                    id="k-{{ $k->id }}"><label
                                                                    class="form-check-label small"
                                                                    for="k-{{ $k->id }}">{{ $k->keterangan }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="criteria-box">
                                        <small class="fw-bold text-info d-block mb-2"><i
                                                class="bi bi-sparkles me-1"></i>Kebersihan Lingkungan</small>
                                        <div class="row row-cols-2 g-2">
                                            @foreach ($kebersihan ?? [] as $b)
                                                <div class="col">
                                                    <div class="form-check"><input class="form-check-input"
                                                            type="checkbox" name="kebersihan[]"
                                                            value="{{ $b->id }}"
                                                            id="b-{{ $b->id }}"><label
                                                            class="form-check-label small"
                                                            for="b-{{ $b->id }}">{{ $b->keterangan }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="criteria-box">
                                        <small class="fw-bold text-warning d-block mb-2"><i
                                                class="bi bi-house-heart me-1"></i>Fasilitas Kamar</small>
                                        <div class="row row-cols-2 g-2">
                                            @foreach ($fasilitas ?? [] as $f)
                                                <div class="col">
                                                    <div class="form-check"><input class="form-check-input"
                                                            type="checkbox" name="fasilitas[]"
                                                            value="{{ $f->id }}"
                                                            id="f-{{ $f->id }}"><label
                                                            class="form-check-label small"
                                                            for="f-{{ $f->id }}">{{ $f->keterangan }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success w-100 py-2.5 fw-bold shadow-sm">
                                <i class="bi bi-lightning-charge me-2"></i>Hitung & Tampilkan Rekomendasi Ideal
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const container = document.getElementById('ajax-dashboard-kost');

                container.addEventListener('click', function(e) {
                    const targetLink = e.target.closest('.pagination a');

                    if (targetLink) {
                        e.preventDefault();
                        const url = targetLink.getAttribute('href');
                        if (url) {
                            fetchData(url);
                        }
                    }
                });

                function fetchData(url) {
                    container.style.opacity = '0.5';

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            container.innerHTML = html;
                            container.style.opacity = '1';

                            // Otomatis scroll fokus ke atas judul Rekomendasi Kost
                            document.getElementById('dashboard-kost-section').scrollIntoView({
                                behavior: 'smooth'
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching dashboard pagination data:', error);
                            container.style.opacity = '1';
                        });
                }
            });
        </script>

        <script>
            document.getElementById("getLocation").onclick = function() {
                if (!navigator.geolocation) {
                    alert("Browser tidak mendukung GPS");
                    return;
                }
                document.getElementById("locationResult").innerHTML =
                    `<div class="spinner-border spinner-border-sm text-primary me-1"></div> Mengambil data koordinat...`;
                navigator.geolocation.getCurrentPosition(async function(position) {
                        let lat = position.coords.latitude;
                        let lng = position.coords.longitude;
                        document.getElementById("lat").value = lat;
                        document.getElementById("lng").value = lng;
                        try {
                            let response = await fetch(
                                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`);
                            let data = await response.json();
                            let locationName = data.address.city || data.address.town || data.address.village ||
                                data.address.suburb || data.display_name;
                            document.getElementById("locationResult").innerHTML =
                                `<i class="bi bi-geo-alt-fill text-success me-1"></i> Lokasi Anda: <b>${locationName}</b>`;
                        } catch (error) {
                            document.getElementById("locationResult").innerHTML =
                                `<i class="bi bi-check-circle-fill text-primary me-1"></i> GPS Sinkron (Nama jalan tidak termuat)`;
                        }
                    },
                    function(error) {
                        document.getElementById("locationResult").innerHTML =
                            `<i class="bi bi-exclamation-triangle-fill text-danger me-1"></i> Gagal melacak: ${error.message}`;
                    });
            };
        </script>

        <script>
            document.getElementById('harga').addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                let formatted = new Intl.NumberFormat('id-ID').format(value);
                e.target.value = value ? 'Rp ' + formatted : '';
            });
        </script>
    @endsection
