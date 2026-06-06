<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Website Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/logo-unima.png') }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('template/landingpage/assets/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/landingpage/assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/landingpage/assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/landingpage/assets/css/main.css') }}" />

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Link Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Styles / Scripts -->
    {{-- @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif --}}

    <style>
        @media(max-width: 576px) {
            .navbar .btn {
                padding: 4px 10px;
                font-size: 14px;
            }
        }

        /* Menyembunyikan teks info tulisan cetak kecil bawaan Laravel */
        .pagination-ajax .flex-1.flex.justify-between,
        .pagination-ajax p.text-sm.text-gray-700 {
            display: none !important;
        }

        /* Memastikan tombol angka Bootstrap berada tepat di tengah */
        .pagination-ajax nav {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        /* Membuat tampilan tombol navigasi sedikit lebih modern */
        .pagination-ajax .page-link {
            color: #0d6efd;
            /* Warna utama biru Bootstrap */
            border-radius: 6px;
            margin: 0 3px;
            border: 1px solid #dee2e6;
        }

        .pagination-ajax .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }
    </style>

</head>

<body class="">

    <!-- Header -->
    <header class="header">
        <div class="navbar-area">
            <div class="container p-0">

                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg align-items-center">

                    <!-- Container Navbar -->
                    <div class="container">

                        <div class="d-flex align-items-center">
                            <!-- Logo + Nama Navbar -->
                            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                                <img src="{{ asset('img/logo-unima.svg') }}" alt="Logo"
                                    style="width: 40px; height: 40px;" />

                                <span class="ms-2 fw-bold mb-0 d-none d-md-inline">Sistem Pemilihan Kost</span>
                            </a>
                        </div>

                        <!-- Toogle Buton -->
                        <button class="navbar-toggler me-4" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <!-- Menu -->
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <div class="ms-auto">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item" style="">
                                        <a class="page-scroll active" href="#home"
                                            style="text-decoration: none;">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#about" style="text-decoration: none;">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#kost" style="text-decoration: none;">Kost</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#faq" style="text-decoration: none;">FAQ</a>
                                    </li>
                                    <li class="nav-item ms-lg-3 d-lg-none">
                                        <a href="{{ route('login') }}" class="main-btn btn-hover p-2"
                                            style="text-decoration: none;">Login</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Button Navbar -->
                            <div class="header-btn">
                                <a href="{{ route('login') }}" class="main-btn btn-hover"
                                    style="text-decoration: none;">Login</a>
                            </div>
                        </div>


                    </div>

                </nav>
                <!-- Akhir Navbar -->

            </div>
        </div>
    </header>
    <!-- Akhir Header -->

    <!-- Section Home -->
    <section id="home" class="hero-section min-vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-10">
                    <div class="hero-content">
                        <h1>Sistem Pemilihan Kost Terbaik</h1>
                        <p>Sistem ini membantu mahasiswa UNIMA memilih kost terbaik berdasarkan kriteria seperti harga,
                            jarak,
                            fasilitas, dan kenyamanan menggunakan metode TOPSIS.</p>

                        <a href="#about" class="main-btn btn-hover">Lihat Fitur</a>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="hero-image text-center text-lg-end">
                        <img src="{{ asset('template/landingpage/assets/images/hero/hero-image.svg') }}"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Section Home -->

    <!-- Section About -->
    <section id="about" class="about-section d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-last order-lg-first">
                    <div class="about-image">
                        <img src="{{ asset('template/landingpage/assets/images/about/about-image.svg') }}"
                            alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content-wrapper">
                        <div class="section-title">
                            <h2 class="mb-20">Solusi Cerdas Memilih Kost dengan Metode TOPSIS</h2>
                            <p class="mb-30">
                                Sistem ini dirancang khusus untuk membantu mahasiswa di kawasan Tondano Selatan,
                                khususnya di sekitar area kampus, dalam menemukan kost yang paling sesuai dengan
                                kebutuhan mereka. Jarak menjadi salah satu kriteria utama dalam perhitungan karena
                                lokasi kost sangat mempengaruhi kenyamanan dan mobilitas mahasiswa.
                            </p>
                            <p class="m-30">
                                Dengan metode TOPSIS, setiap kost akan dihitung dan dibandingkan untuk menghasilkan
                                rekomendasi terbaik yang paling sesuai dengan kebutuhan pengguna.
                            </p>
                            <a href="{{ route('login') }}" class="main-btn btn-hover border-btn mt-5 mb-20">Coba
                                Sekarang!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section Akhir About -->

    <!-- Section Kost -->
    <section id="kost" class="min-vh-100 d-flex align-items-center mt-5">
        <div class="container">

            <div class="row align-items-center mb-4">
                <div class="col-md-12">
                    <h3 class="fw-bold">Daftar Kost</h3>
                    <p class="text-muted">Silahkan login atau klik pada kost yang ingin Anda lihat, untuk menampilkan
                        detail kost.</p>
                </div>
            </div>

            <div id="ajax-kost-container">
                <div class="row g-4">
                    @foreach ($kosts as $kos)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <a class="card border-0 shadow-sm h-100 text-decoration-none text-dark"
                                href="{{ route('login') }}">
                                <div class="position-relative">
                                    <img src="{{ $kos->foto->isNotEmpty() ? asset('storage/' . $kos->foto->first()->foto) : asset('template/paneladmin/assets/img/background/1.jpg') }}"
                                        class="card-img-top kost-img" style="height: 200px; object-fit: cover;"
                                        alt="kost">
                                    <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                        {{ $kos->jenis->jenis_kost ?? 'Tidak Ada Jenis' }}
                                    </span>
                                </div>
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h6 class="fw-bold mb-1 text-truncate">{{ $kos->nama_kost }}</h6>
                                        <small class="text-muted d-block mb-2">
                                            {{ $kos->daerah->name ?? 'Tidak Ada Daerah' }}
                                        </small>
                                        <p class="text-muted small text-truncate mb-3">
                                            {{ $kos->fasilitas->isEmpty() ? 'Tidak Ada Fasilitas' : $kos->fasilitas->implode('keterangan', ', ') }}
                                        </p>
                                    </div>
                                    <h6 class="text-primary fw-bold mb-0">Rp
                                        {{ number_format($kos->harga, 0, ',', '.') }}<span
                                            class="text-muted small fw-normal">/bln</span></h6>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-5 pagination-ajax">
                    {{ $kosts->links() }}
                </div>
            </div>

        </div>
    </section>

    <!-- Section FAQ -->
    <section id="faq" class="d-flex align-items-center mb-5 mt-5">
        <div class="container">

            <div class="text-center mb-2">
                <h2>Pertanyaan yang sering diajukan</h2>
                <p>Dapatkan jawaban cepat atas pertanyaan yang sering muncul seputar fitur dan cara <br>kerja sistem
                    kami dalam membantu Anda menemukan kost terbaik.</p>
            </div>

            <div class="row justify-content-center">

                <div class="col-md-8 col-lg-6">

                    <div class="accordion" id="accordionExample">
                        <!-- Pertanyaan 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Bagaimana cara mencari kost yang sesuai dengan kebutuhan saya?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>Anda dapat langsung melihat daftar kost yang tersedia di halaman utama.
                                        Gunakan fitur pencarian atau filter berdasarkan daerah, jenis kost
                                        (Putra/Putri/Campuran), dan fasilitas yang Anda inginkan untuk mempersempit
                                        hasil pencarian.</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Pertanyaan 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Apa arti dari label "Putra", "Putri", dan "Campuran" pada kartu kost?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>"Putra" berarti kost yang hanya untuk laki-laki, "Putri" berarti kost yang
                                        hanya untuk perempuan, dan "Campuran" berarti kost yang bisa digunakan oleh
                                        keduanya.</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Pertanyaan 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Apakah harga yang tertera di website sudah termasuk biaya listrik dan air?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>Kebijakan ini berbeda-beda untuk setiap kost. Beberapa kost sudah menyatukan
                                        biaya listrik/air ke dalam harga sewa bulanan, dan beberapa lainnya menerapkan
                                        sistem token listrik mandiri. Anda bisa membaca informasi detail ini pada
                                        deskripsi lengkap masing-masing kost.</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Pertanyaan 4 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseFour">
                                    Bagaimana cara saya melihat foto-foto kondisi kamar kost?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>Cukup klik pada kartu kost yang Anda minati. Anda akan diarahkan ke halaman
                                        detail kost yang menyediakan galeri foto lengkap, mulai dari foto kamar tidur,
                                        kamar mandi, hingga fasilitas bersama.</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Pertanyaan 5 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false"
                                    aria-controls="collapseFive">
                                    Apakah fasilitas yang tertulis di website dijamin tersedia di lokasi?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>Ya, semua fasilitas yang tertera (seperti Wi-Fi, AC, Kasur, Lemari, atau
                                        Kamar Mandi Dalam) telah diverifikasi dan di-update secara berkala oleh pemilik
                                        kost.</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Pertanyaan 6 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Saya tertarik dengan salah satu kost, bagaimana cara memesan atau menghubungi
                                    pemiliknya?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>Silakan klik tombol "Login" atau "Daftar" terlebih dahulu untuk membuat
                                        akun. Setelah masuk ke sistem, Anda akan mendapatkan akses penuh untuk melihat
                                        kontak pemilik kost atau melakukan pengajuan sewa langsung.</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Pertanyaan 7 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSeven" aria-expanded="false"
                                    aria-controls="collapseSeven">
                                    Apakah sistem keamanan di kost-kost yang terdaftar dijamin aman?
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse"
                                aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>Setiap kost memiliki informasi indikator keamanan masing-masing di halaman
                                        detailnya, seperti ketersediaan CCTV 24 jam, penjagaan satpam, atau sistem
                                        gerbang satu pintu (one-gate system).</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Pertanyaan 8 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseEight" aria-expanded="false"
                                    aria-controls="collapseEight">
                                    Bisakah saya melakukan survei lokasi langsung sebelum membayar?
                                </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse"
                                aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>Sangat disarankan! Anda bisa menghubungi nomor pengelola/pemilik kost yang
                                        tertera setelah Anda login untuk membuat janji temu dan melakukan survei
                                        langsung ke lokasi.</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Pertanyaan 9 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingNine">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseNine" aria-expanded="false"
                                    aria-controls="collapseNine">
                                    Bagaimana sistem pembayaran sewa kost di SIPKOST?
                                </button>
                            </h2>
                            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>Sistem pembayaran dapat disepakati langsung dengan pemilik kost setelah Anda
                                        melakukan pengajuan, baik melalui transfer bank maupun pembayaran tunai sesuai
                                        dengan kesepakatan kontrak.</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Pertanyaan 10 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTen">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                    Apakah ada biaya tambahan saat menggunakan website SIPKOST untuk mencari kost?
                                </button>
                            </h2>
                            <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>Tidak ada. Layanan pencarian, melihat detail fasilitas, dan melihat
                                        informasi kost di website SIPKOST 100% gratis untuk seluruh calon penghuni
                                        kost.</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

        </div>
    </section>
    <!-- Akhir Section FAQ -->

    <!-- Footer -->
    @include('layouts.footer')
    <!-- Section Akhir Kost -->


    <!-- JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById('ajax-kost-container');

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
                // efek transisi
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

                        document.getElementById('kost').scrollIntoView({
                            behavior: 'smooth'
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching pagination data:', error);
                        container.style.opacity = '1';
                    });
            }
        });
    </script>
</body>

</html>
