<footer class="footer pt-40" style="background-color: #56B6C6;">
    <div class="px-6 container">

        <!-- Konten Utama -->
        <div class="row">

            <!-- Kolom 1 -->
            <div class="col-xl-5 col-lg-4 col-md-6 col-sm-10 d-none d-md-inline">
                <div class="footer-widget">

                    <div class="d-flex align-items-center mb-1">
                        <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                            <img src="<?php echo e(asset('img/logo-unima.svg')); ?>" alt="Logo"
                                style="width: 40px; height: 40px;" class="" />
                            <h3 class="m-0">Sistem Pemilihan Kos</h3>
                        </a>
                    </div>

                    <p class="desc">
                        Sistem ini membantu mahasiswa UNIMA memilih kost terbaik berdasarkan kriteria seperti harga,
                        jarak, fasilitas, dan kenyamanan menggunakan metode TOPSIS.
                    </p>

                    <ul class="social-links">
                        <li>
                            <a href="#0"><i class="lni lni-instagram"></i></a>
                        </li>
                    </ul>

                </div>
            </div>

            <!-- Kolom 2 -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 offset-xl-1">
                <div class="footer-widget">
                    <h3 class="m-0">Tentang Kami</h3>
                    <ul class="links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#kost">Kost</a></li>
                        <li><a href="#faq">FAQ</a></li>
                    </ul>
                </div>
            </div>

            <!-- Kolom 3 -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="footer-widget">
                    <h3 class="m-0">Pelayanan Kami</h3>
                    <ul class="links">
                        <li><a href="#">Rekomendasi Kos</a></li>
                        <li><a href="<?php echo e(route('login')); ?>">Kos di FATEK</a></li>
                        <li><a href="<?php echo e(route('login')); ?>">Kos di FEB</a></li>
                        <li><a href="<?php echo e(route('login')); ?>">Kos di FIKKM</a></li>
                        <li><a href="<?php echo e(route('login')); ?>">Kos di FISH</a></li>
                        <li><a href="<?php echo e(route('login')); ?>">Kos di FEB</a></li>
                        <li><a href="<?php echo e(route('login')); ?>">Kos di FBS</a></li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- BOTTOM FOOTER (PALING BAWAH) -->
        <div class="row">
            <div class="col-12 text-center text-white mt-1 mb-3">
                <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                    <div class="mb-2 mb-md-0">
                        ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        made with ❤️ by
                        <a href="https://instagram.com/wilsonandrn" target="_blank" class="footer-link">wilson</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</footer>
<?php /**PATH C:\laravel\spk-topsis\resources\views/layouts/footer.blade.php ENDPATH**/ ?>