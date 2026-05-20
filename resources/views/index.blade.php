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

            <!-- Header -->
            <div class="row align-items-center mb-5">

                <!-- Teks kiri -->
                <div class="col-md-8">
                    <h3>Rekomendasi Kost di</h3>
                    <p>Rekomendasi kost terbaik berdasarkan perhitungan sistem TOPSIS</p>
                </div>

                <!-- Tombol kanan -->
                <div class="col-md-4 d-none d-md-flex justify-content-end gap-3">
                    <div class="swiper-button-prev position-static mt-0 text-dark"
                        style="--swiper-navigation-size: 35px"></div>
                    <div class="swiper-button-next position-static mt-0 text-dark"
                        style="--swiper-navigation-size: 35px"></div>
                </div>

            </div>

            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <!-- Card 1 -->
                    <div class="swiper-slide">
                        <div class="card border-0 shadow-sm flex-fill">
                            <div class="position-relative">
                                <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img"
                                    alt="kost">
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                <small class="text-muted d-block mb-2">Tataaran Patar</small>
                                <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam dan segala macamm</p>
                                <h6 class="text-primary fw-bold">Rp2.500.000/bulan</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="swiper-slide">
                        <div class="card border-0 shadow-sm flex-fill">
                            <div class="position-relative">
                                <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img"
                                    alt="kost">
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                <small class="text-muted d-block mb-2">Tataaran Patar</small>
                                <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam</p>
                                <h6 class="text-primary fw-bold">Rp2.500.000/bulan</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="swiper-slide">
                        <div class="card border-0 shadow-sm flex-fill">
                            <div class="position-relative">
                                <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img"
                                    alt="kost">
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                <small class="text-muted d-block mb-2">Tataaran Patar</small>
                                <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam</p>
                                <h6 class="text-primary fw-bold">Rp2.500.000/bulan</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="swiper-slide">
                        <div class="card border-0 shadow-sm flex-fill">
                            <div class="position-relative">
                                <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img"
                                    alt="kost">
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                <small class="text-muted d-block mb-2">Tataaran Patar</small>
                                <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam
                                    asdasdasdsadas</p>
                                <h6 class="text-primary fw-bold">Rp2.500.000/bulan</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="swiper-slide">
                        <!-- Card 1 -->
                        <div class="card border-0 shadow-sm flex-fill">
                            <div class="position-relative">
                                <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img"
                                    alt="kost">
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                <small class="text-muted d-block mb-2">Tataaran Patar</small>
                                <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam</p>
                                <h6 class="text-primary fw-bold">Rp2.500.000/bulan</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6 -->
                    <div class="swiper-slide">
                        <div class="card border-0 shadow-sm flex-fill">
                            <div class="position-relative">
                                <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img"
                                    alt="kost">
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                <small class="text-muted d-block mb-2">Tataaran Patar</small>
                                <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam</p>
                                <h6 class="text-primary fw-bold">Rp2.500.000/bulan</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Card 7 -->
                    <div class="swiper-slide">
                        <div class="card border-0 shadow-sm flex-fill">
                            <div class="position-relative">
                                <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img"
                                    alt="kost">
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                <small class="text-muted d-block mb-2">Tataaran Patar</small>
                                <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam</p>
                                <h6 class="text-primary fw-bold">Rp2.500.000/bulan</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Card 8 -->
                    <div class="swiper-slide">
                        <div class="card border-0 shadow-sm flex-fill">
                            <div class="position-relative">
                                <img src="{{ asset('img/kost1.jpg') }}" class="card-img-top kost-img"
                                    alt="kost">
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">Campur</span>
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold mb-1">Kost Cendrawasih</h6>
                                <small class="text-muted d-block mb-2">Tataaran Patar</small>
                                <p class="text-muted small text-truncate">WiFi • AC • Kamar Mandi Dalam
                                    asdasdasdsadas</p>
                                <h6 class="text-primary fw-bold">Rp2.500.000/bulan</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- Section FAQ -->
    <section id="faq" class="d-flex align-items-center mb-5">
        <div class="container">

            <div class="text-center mb-2">
                <h2>Pertanyaan yang sering diajukan</h2>
                <p>Dapatkan jawaban cepat atas pertanyaan yang sering muncul seputar fitur dan cara <br>kerja sistem
                    kami dalam membantu Anda menemukan kost terbaik.</p>
            </div>

            <div class="row justify-content-center">

                <div class="col-md-8 col-lg-6">

                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Bagaimana cara menggunakan aplikasi ini?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>Sabar</strong>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Kapan aplikasi ini selesai?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>Sabar</strong>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Kok sabar terus?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>Karena sabar adalah sebagian dari iman.</strong>
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

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 20,

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            breakpoints: {
                0: {
                    slidesPerView: 1,
                },

                768: {
                    slidesPerView: 2,
                },

                992: {
                    slidesPerView: 4,
                }
            }
        });
    </script>
</body>

</html>
