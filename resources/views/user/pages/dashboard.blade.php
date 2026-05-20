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

    <div class="">

        <!-- Rekomendasi Kost Terbaik Sesuai Fakultas -->
        <div class="container mt-2">

            <!-- Header -->
            <div class="row align-items-center mb-5">

                <!-- Teks kiri -->
                <div class="col-md-8">
                    <h3 class="mb-0" style="line-height: 1.5;">
                        Rekomendasi kost di, Fakultas {{ $fakultas[Auth::user()->fakultas] }}
                    </h3>

                </div>

                <!-- Tombol kanan -->
                <div class="col-md-4 d-none d-md-flex justify-content-end gap-3">
                    <div class="swiper-button-prev dashboard-prev position-static mt-0 text-dark"
                        style="--swiper-navigation-size: 35px"></div>
                    <div class="swiper-button-next dashboard-next position-static mt-0 text-dark"
                        style="--swiper-navigation-size: 35px"></div>
                </div>

            </div>

            <!-- Swiper -->
            <div class="swiper dashboardSwiper">
                <div class="swiper-wrapper">
                    <!-- Card 1 -->
                    <div class="swiper-slide">
                        <a href="#" class="text-decoration-none text-dark">

                            <div class="card border-0 shadow-sm flex-fill kost-card">
                                <div class="position-relative">
                                    <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img" alt="kost">
                                    <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                                </div>
                                <div class="card-body">
                                    <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                    <small class="text-muted d-block">Tataaran Patar</small>
                                    <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam</p>
                                    <h6 class="text-primary fw-bold mb-0">Rp2.500.000/bulan</h6>
                                </div>
                            </div>

                        </a>
                    </div>

                    <!-- Card 2 -->
                    <div class="swiper-slide">
                        <a href="#" class="text-decoration-none text-dark">

                            <div class="card border-0 shadow-sm flex-fill kost-card">
                                <div class="position-relative">
                                    <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img" alt="kost">
                                    <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                                </div>
                                <div class="card-body">
                                    <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                    <small class="text-muted d-block">Tataaran Patar</small>
                                    <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam</p>
                                    <h6 class="text-primary fw-bold mb-0">Rp2.500.000/bulan</h6>
                                </div>
                            </div>

                        </a>
                    </div>

                    <!-- Card 3 -->
                    <div class="swiper-slide">
                        <a href="#" class="text-decoration-none text-dark">

                            <div class="card border-0 shadow-sm flex-fill kost-card">
                                <div class="position-relative">
                                    <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img" alt="kost">
                                    <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                                </div>
                                <div class="card-body">
                                    <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                    <small class="text-muted d-block">Tataaran Patar</small>
                                    <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam</p>
                                    <h6 class="text-primary fw-bold mb-0">Rp2.500.000/bulan</h6>
                                </div>
                            </div>

                        </a>
                    </div>

                    <!-- Card 4 -->
                    <div class="swiper-slide">
                        <a href="#" class="text-decoration-none text-dark">

                            <div class="card border-0 shadow-sm flex-fill kost-card">
                                <div class="position-relative">
                                    <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img" alt="kost">
                                    <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                                </div>
                                <div class="card-body">
                                    <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                    <small class="text-muted d-block">Tataaran Patar</small>
                                    <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam</p>
                                    <h6 class="text-primary fw-bold mb-0">Rp2.500.000/bulan</h6>
                                </div>
                            </div>

                        </a>
                    </div>

                    <!-- Card 5 -->
                    <div class="swiper-slide">
                        <a href="#" class="text-decoration-none text-dark">

                            <div class="card border-0 shadow-sm flex-fill kost-card">
                                <div class="position-relative">
                                    <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img" alt="kost">
                                    <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                                </div>
                                <div class="card-body">
                                    <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                    <small class="text-muted d-block">Tataaran Patar</small>
                                    <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam</p>
                                    <h6 class="text-primary fw-bold mb-0">Rp2.500.000/bulan</h6>
                                </div>
                            </div>

                        </a>
                    </div>

                    <!-- Card 6 -->
                    <div class="swiper-slide">
                        <a href="#" class="text-decoration-none text-dark">

                            <div class="card border-0 shadow-sm flex-fill kost-card">
                                <div class="position-relative">
                                    <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img" alt="kost">
                                    <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                                </div>
                                <div class="card-body">
                                    <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                    <small class="text-muted d-block">Tataaran Patar</small>
                                    <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam</p>
                                    <h6 class="text-primary fw-bold mb-0">Rp2.500.000/bulan</h6>
                                </div>
                            </div>

                        </a>
                    </div>

                    <!-- Card 7 -->
                    <div class="swiper-slide">
                        <a href="#" class="text-decoration-none text-dark">

                            <div class="card border-0 shadow-sm flex-fill kost-card">
                                <div class="position-relative">
                                    <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img" alt="kost">
                                    <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                                </div>
                                <div class="card-body">
                                    <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                    <small class="text-muted d-block">Tataaran Patar</small>
                                    <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam</p>
                                    <h6 class="text-primary fw-bold mb-0">Rp2.500.000/bulan</h6>
                                </div>
                            </div>

                        </a>
                    </div>

                    <!-- Card 8 -->
                    <div class="swiper-slide">
                        <a href="#" class="text-decoration-none text-dark">

                            <div class="card border-0 shadow-sm flex-fill kost-card">
                                <div class="position-relative">
                                    <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img" alt="kost">
                                    <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                                </div>
                                <div class="card-body">
                                    <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                    <small class="text-muted d-block">Tataaran Patar</small>
                                    <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam</p>
                                    <h6 class="text-primary fw-bold mb-0">Rp2.500.000/bulan</h6>
                                </div>
                            </div>

                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Filter Kost -->
        <div class="container mt-2 mb-2">
            <div class="mt-4">
                <div class="card border-0 shadow-sm p-3">
                    <div class="row g-3 align-items-center">

                        <!-- Kota -->
                        <div class="col-md-4">
                            <small class="fw-bold">Fakultas</small>
                            <select class="form-select">
                                <option>Fakultas Teknik</option>
                                <option>Fakultas Bahasa dan Seni</option>
                                <option>Fakultas Ilmu Sosial dan Hukum</option>
                                <option>Fakultas Ilmu Keolahragaan dan Kesehatan Masyarakat</option>
                                <option>Fakultas Ilmu Pendidikan</option>
                                <option>Fakultas Kedokteran</option>
                                <option>Fakultas Ekonomi dan Bisnis</option>
                            </select>
                        </div>

                        <!-- Tipe Kost -->
                        <div class="col-md-2">
                            <small class="fw-bold">Daerah</small>
                            <select class="form-select">
                                <option>Tataaran Patar</option>
                                <option>Tataaran 1</option>
                                <option>Tataaran 2</option>
                                <option>Perum Blok A</option>
                                <option>Perum Blok B</option>
                                <option>Perum Blok C</option>
                                <option>Perum Blok D</option>
                                <option>Lorong SMA</option>
                                <option>Lorong Pasar</option>
                                <option>Lorong Bengkel</option>
                                <option>Lorong Popay</option>
                                <option>Lorong LAJ</option>
                            </select>
                        </div>

                        <!-- Tipe Sewa -->
                        <div class="col-md-2">
                            <small class="fw-bold">Tipe Kos</small>
                            <select class="form-select">
                                <option>Campur</option>
                                <option>Pria</option>
                                <option>Wanita</option>
                            </select>
                        </div>

                        <!-- Harga Min -->
                        <div class="col-md-2">
                            <small class="fw-bold">Harga Minimum</small>
                            <input type="number" class="form-control" placeholder="Rp 300.000">
                        </div>

                        <!-- Harga Max -->
                        <div class="col-md-2">
                            <small class="fw-bold">Harga Maksimum</small>
                            <input type="text" class="form-control" placeholder="Rp 1.000.000">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mt-1">
                        <!-- Button -->
                        <div class="col-md-12">
                            <button class="btn btn-success w-100">
                                Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4">

            <div class="row g-3">

                <!-- CARD 5 -->
                <div class="col-6 col-md-3">
                    <a href="#" class="text-dark text-decoration-none">
                        <div class="card border-0 shadow-sm kost-card h-100">
                            <div class="position-relative">
                                <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img">
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                    Campur
                                </span>
                            </div>

                            <div class="card-body">
                                <h6 class="fw-bold">Kost Queen Gracia</h6><small class="text-muted">Tataaran Patar</small>
                                <p class="truncate-2">WiFi • AC • .asdasdasdasda..</p>
                                <h6 class="text-primary">Rp2.500.000</h6>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="#" class="text-dark text-decoration-none">
                        <div class="card border-0 shadow-sm kost-card h-100">
                            <div class="position-relative">
                                <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img">
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                    Campur
                                </span>
                            </div>

                            <div class="card-body">
                                <h6 class="fw-bold">Kost Queen Gracia</h6><small class="text-muted">Tataaran Patar</small>
                                <p class="truncate-2">WiFi • AC • .asdasdasdasda..</p>
                                <h6 class="text-primary">Rp2.500.000</h6>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="#" class="text-dark text-decoration-none">
                        <div class="card border-0 shadow-sm kost-card h-100">
                            <div class="position-relative">
                                <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img">
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                    Campur
                                </span>
                            </div>

                            <div class="card-body">
                                <h6 class="fw-bold">Kost Queen Gracia</h6><small class="text-muted">Tataaran Patar</small>
                                <p class="truncate-2">WiFi • AC • .asdasdasdasda..</p>
                                <h6 class="text-primary">Rp2.500.000</h6>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="#" class="text-dark text-decoration-none">
                        <div class="card border-0 shadow-sm kost-card h-100">
                            <div class="position-relative">
                                <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img">
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                    Campur
                                </span>
                            </div>

                            <div class="card-body">
                                <h6 class="fw-bold">Kost Queen Gracia</h6><small class="text-muted">Tataaran Patar</small>
                                <p class="truncate-2">WiFi • AC • .asdasdasdasda..</p>
                                <h6 class="text-primary">Rp2.500.000</h6>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="#" class="text-dark text-decoration-none">
                        <div class="card border-0 shadow-sm kost-card h-100">
                            <div class="position-relative">
                                <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img">
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                    Campur
                                </span>
                            </div>

                            <div class="card-body">
                                <h6 class="fw-bold">Kost Queen Gracia</h6><small class="text-muted">Tataaran Patar</small>
                                <p class="truncate-2">WiFi • AC • .asdasdasdasda..</p>
                                <h6 class="text-primary">Rp2.500.000</h6>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="#" class="text-dark text-decoration-none">
                        <div class="card border-0 shadow-sm kost-card h-100">
                            <div class="position-relative">
                                <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img">
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                    Campur
                                </span>
                            </div>

                            <div class="card-body">
                                <h6 class="fw-bold">Kost Queen Gracia</h6><small class="text-muted">Tataaran Patar</small>
                                <p class="truncate-2">WiFi • AC • .asdasdasdasda..</p>
                                <h6 class="text-primary">Rp2.500.000</h6>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- Pagination --}}
                <div class="row mt-3 ms-1">
                    <div class="col-12">
                        <ul class="pagination pagination-sm justify-content-center mb-0">
                            <li class="page-item active"><span class="page-link">1</span></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">10</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-5">

            <h4 class="fw-bold mb-3 text-center">
                Sistem Pemilihan Kost Menggunakan Metode TOPSIS
            </h4>

            <div class="d-flex justify-content-center">
                <div style="max-width: 700px; width: 100%;">
                    <p class="text-muted fs-6 mb-0" style="text-align: justify">
                        Dalam memilih kost yang ideal, setiap orang tentu memiliki banyak pertimbangan seperti harga,
                        lokasi, fasilitas, hingga kenyamanan. Karena banyaknya faktor yang harus dibandingkan, proses
                        pengambilan keputusan sering kali menjadi tidak mudah dan memakan waktu. Untuk itu, sistem ini hadir
                        dengan pendekatan <b>TOPSIS (Technique for Order Preference by Similarity to Ideal Solution)</b>,
                        yaitu sebuah metode dalam sistem pendukung keputusan yang mampu membandingkan banyak alternatif
                        secara objektif berdasarkan beberapa kriteria yang telah ditentukan. Dengan metode ini, setiap
                        pilihan kost akan dihitung tingkat kedekatannya terhadap solusi ideal terbaik, sehingga menghasilkan
                        rekomendasi yang lebih akurat dan terukur.
                    </p>
                </div>
            </div>

            <!-- BUTTON TOGGLE -->
            <div class="text-center mt-3">
                <button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="collapse"
                    data-bs-target="#preferensiTopsis" aria-expanded="false" aria-controls="preferensiTopsis">
                    Coba Sekarang
                </button>
            </div>

            <!-- FORM COLLAPSE -->
            <div class="collapse mt-3" id="preferensiTopsis">

                <div class="d-flex justify-content-center">
                    <div class="card border-0 shadow-sm p-3" style="max-width: 900px; width:100%;">

                        <h6 class="fw-bold text-center">
                            Technique for Order Preference by Similarity to Ideal Solution
                        </h6>

                        <p class="text-muted small text-center mb-3">
                            Isi sesuai kebutuhanmu. Sistem akan menyesuaikan rekomendasi berdasarkan preferensi ini.
                        </p>

                        <form>

                            <!-- Harga -->
                            <div class="mb-2">
                                <label class="form-label">Rentang Harga (maksimal)</label>
                                <input type="text" id="harga" class="form-control form-control-sm"
                                    placeholder="Rp 100.000">
                            </div>

                            <!-- Lokasi -->
                            <div class="mb-2">
                                <label class="form-label">Lokasi Anda</label>

                                <button type="button" class="btn btn-primary btn-sm w-100" id="getLocation">
                                    Gunakan Lokasi Saya (GPS)
                                </button>

                                <div class="mt-2 small text-muted" id="locationResult">
                                    Lokasi belum diambil
                                </div>

                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lng" id="lng">
                            </div>

                            <!-- KEAMANAN -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Keamanan</label>

                                <div class="row row-cols-3">

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="keamanan[]"
                                                value="cctv">
                                            <label class="form-check-label">CCTV</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="keamanan[]"
                                                value="satpam">
                                            <label class="form-check-label">Satpam 24 Jam</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="keamanan[]"
                                                value="akses_kartu">
                                            <label class="form-check-label">Akses Kartu</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="keamanan[]"
                                                value="gerbang">
                                            <label class="form-check-label">Gerbang Terkunci</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="keamanan[]"
                                                value="cctv_24h">
                                            <label class="form-check-label">CCTV 24 Jam</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="keamanan[]"
                                                value="security_gate">
                                            <label class="form-check-label">Security Gate</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="keamanan[]"
                                                value="lampu_jalan">
                                            <label class="form-check-label">Lampu Jalan</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="keamanan[]"
                                                value="kunci_pintu">
                                            <label class="form-check-label">Kunci Pintu Ganda</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="keamanan[]"
                                                value="pos_jaga">
                                            <label class="form-check-label">Pos Jaga</label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- KEBERSIHAN -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Kebersihan</label>

                                <div class="row row-cols-3">

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bersih1"
                                                name="kebersihan[]" value="petugas">
                                            <label class="form-check-label" for="bersih1">Petugas Kebersihan</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bersih2"
                                                name="kebersihan[]" value="tempat_sampah">
                                            <label class="form-check-label" for="bersih2">Tempat Sampah Tersedia</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bersih3"
                                                name="kebersihan[]" value="jadwal_bersih">
                                            <label class="form-check-label" for="bersih3">Jadwal Bersih Rutin</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bersih4"
                                                name="kebersihan[]" value="kamar_bersih">
                                            <label class="form-check-label" for="bersih4">Kamar Bersih</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bersih5"
                                                name="kebersihan[]" value="drainase_baik">
                                            <label class="form-check-label" for="bersih5">Saluran Air Lancar</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bersih6"
                                                name="kebersihan[]" value="bau_rumah_baik">
                                            <label class="form-check-label" for="bersih6">Tidak Bau Tidak Sedap</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bersih7"
                                                name="kebersihan[]" value="lantai_bersih">
                                            <label class="form-check-label" for="bersih7">Lantai Bersih</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bersih8"
                                                name="kebersihan[]" value="kamar_mandi_bersih">
                                            <label class="form-check-label" for="bersih8">Kamar Mandi Bersih</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bersih9"
                                                name="kebersihan[]" value="bebas_hama">
                                            <label class="form-check-label" for="bersih9">Bebas Hama / Serangga</label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- FASILITAS -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Fasilitas</label>

                                <div class="row row-cols-3">

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="fasilitas1"
                                                name="fasilitas[]" value="wifi">
                                            <label class="form-check-label" for="fasilitas1">WiFi</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="fasilitas2"
                                                name="fasilitas[]" value="ac">
                                            <label class="form-check-label" for="fasilitas2">AC</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="fasilitas3"
                                                name="fasilitas[]" value="dapur">
                                            <label class="form-check-label" for="fasilitas3">Dapur</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="fasilitas4"
                                                name="fasilitas[]" value="parkir">
                                            <label class="form-check-label" for="fasilitas4">Parkir</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="fasilitas5"
                                                name="fasilitas[]" value="air_panas">
                                            <label class="form-check-label" for="fasilitas5">Air Panas</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="fasilitas6"
                                                name="fasilitas[]" value="kasur">
                                            <label class="form-check-label" for="fasilitas6">Kasur</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="fasilitas7"
                                                name="fasilitas[]" value="lemari">
                                            <label class="form-check-label" for="fasilitas7">Lemari</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="fasilitas8"
                                                name="fasilitas[]" value="meja_kursi">
                                            <label class="form-check-label" for="fasilitas8">Meja & Kursi</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="fasilitas9"
                                                name="fasilitas[]" value="laundry">
                                            <label class="form-check-label" for="fasilitas9">Laundry</label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-sm w-100 mt-2">
                                Terapkan Preferensi
                            </button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Fungsi Lokasi -->
    <script>
        document.getElementById("getLocation").onclick = function() {

            if (!navigator.geolocation) {
                alert("Browser tidak mendukung GPS");
                return;
            }

            navigator.geolocation.getCurrentPosition(async function(position) {

                    let lat = position.coords.latitude;
                    let lng = position.coords.longitude;

                    // simpan koordinat untuk backend
                    document.getElementById("lat").value = lat;
                    document.getElementById("lng").value = lng;

                    // reverse geocoding (ambil nama lokasi)
                    try {
                        let response = await fetch(
                            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`
                        );

                        let data = await response.json();

                        let locationName =
                            data.address.city ||
                            data.address.town ||
                            data.address.village ||
                            data.address.suburb ||
                            data.display_name;

                        document.getElementById("locationResult").innerHTML =
                            "📍 Lokasi Anda: <b>" + locationName + "</b>";

                    } catch (error) {
                        document.getElementById("locationResult").innerHTML =
                            "📍 Lokasi berhasil diambil (nama tidak tersedia)";
                    }

                },
                function(error) {

                    document.getElementById("locationResult").innerHTML =
                        "❌ Gagal mengambil lokasi: " + error.message;
                });

        };
    </script>

    <!-- Fungsi Harga -->
    <script>
        document.getElementById('harga').addEventListener('input', function(e) {
            let value = e.target.value;

            // hapus semua selain angka
            value = value.replace(/\D/g, '');

            // format ke rupiah
            let formatted = new Intl.NumberFormat('id-ID').format(value);

            e.target.value = value ? 'Rp ' + formatted : '';
        });
    </script>

    <!-- Fungsi Swiper -->
    <script>
        var swiper = new Swiper(".dashboardSwiper", {
            spaceBetween: 20,
            slidesPerView: "auto",

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 4
                }
            }
        });
    </script>
@endsection
