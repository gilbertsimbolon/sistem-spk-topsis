<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?php echo e(route('admin.dashboard.index')); ?>" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="<?php echo e(asset('img/logo-unima.svg')); ?>" alt="Logo UNIMA" style="width: 40px; height: 40px">
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2" style="font-size: 20px">SIPKOS</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left d-block align-middle"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- Dashboard -->
        <li class="menu-item <?php echo e(request()->routeIs('admin.dashboard.index') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('admin.dashboard.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Dashboards">Dashboard</div>
            </a>
        </li>

        <!-- Manajemen Kost -->
        <li class="menu-item <?php echo e(request()->routeIs('data-kost.*') || request()->routeIs('fasilitas.*') || request()->routeIs('jenis-kost.*') || request()->routeIs('daerah.index') ? 'active open' : ''); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-buildings"></i>
                <div class="text-truncate" data-i18n="Layouts">Manajemen Kost</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?php echo e(route('data-kost.index')); ?>" class="menu-link">
                        <div class="text-truncate" data-i18n="Without menu">Data Kost</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo e(route('fasilitas.index')); ?>" class="menu-link">
                        <div class="text-truncate" data-i18n="Without navbar">Fasilitas Kost</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo e(route('jenis-kost.index')); ?>" class="menu-link">
                        <div class="text-truncate" data-i18n="Fluid">Jenis Kost</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo e(route('daerah.index')); ?>" class="menu-link">
                        <div class="text-truncate" data-i18n="Fluid">Daerah Kost</div>
                    </a>
                </li>
            </ul>
        </li>



        <!-- Kriteria Topsis -->
        <li class="menu-item <?php echo e(request()->routeIs('kriteria.*') || request()->routeIs('bobot.*') || request()->routeIs('sub-kriteria.*') || request()->routeIs('penilaian-alternatif.*') ? 'active open' : ''); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                <div class="text-truncate" data-i18n="Front Pages">Kriteria Topsis</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?php echo e(route('data-kriteria.index')); ?>"
                        class="menu-link">
                        <div class="text-truncate">Data Kriteria</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo e(route('sub-kriteria.index')); ?>"
                        class="menu-link">
                        <div class="text-truncate">Sub Kriteria</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo e(route('penilaian-alternatif.index')); ?>"
                        class="menu-link">
                        <div class="text-truncate">Penilaian Alternatif</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo e(route('topsis.hitung')); ?>"
                        class="menu-link">
                        <div class="text-truncate">Perhitungan</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Manajemen User -->
        <li class="menu-item <?php echo e(request()->routeIs('user.*') || request()->routeIs('owner.*') ? 'active open' : ''); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>

                <div class="text-truncate">
                    Manajemen User
                </div>
            </a>

            <ul class="menu-sub">

                <!-- Semua User -->
                <li class="menu-item">
                    <a href="<?php echo e(route('semua-user.index')); ?>" class="menu-link">
                        <div class="text-truncate">
                            Semua User
                        </div>
                    </a>
                </li>

                <!-- Owner Kost -->
                <li class="menu-item">
                    <a href="<?php echo e(route('owner.index')); ?>" class="menu-link">
                        <div class="text-truncate">
                            Owner Kost
                        </div>
                    </a>
                </li>

                <!-- Admin -->
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div class="text-truncate">
                            Data Admin
                        </div>
                    </a>
                </li>

            </ul>
        </li>

        <!-- Laporan -->
        <li class="menu-item <?php echo e(request()->routeIs('laporan.*') ? 'active open' : ''); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div class="text-truncate" data-i18n="Front Pages">Laporan Ranking</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/landing-page.html"
                        class="menu-link" target="_blank">
                        <div class="text-truncate" data-i18n="Landing">Laporan Data Kost</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/pricing-page.html"
                        class="menu-link" target="_blank">
                        <div class="text-truncate" data-i18n="Pricing">Statistik Sistem</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Logout -->
        <li class="menu-item">
            <form action="#" method="POST">
                <?php echo csrf_field(); ?>

                <button type="submit"
                    class="menu-link border-0 bg-transparent w-100 text-start">

                    <i class="menu-icon tf-icons bx bx-log-out"></i>

                    <div class="text-truncate">
                        Logout
                    </div>

                </button>
            </form>
        </li>
    </ul>
</aside><?php /**PATH C:\laravel\spk-topsis\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>