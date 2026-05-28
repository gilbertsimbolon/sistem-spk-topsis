<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('img/logo-unima.svg') }}" alt="Logo UNIMA" style="width: 40px; height: 40px">
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
        <li class="menu-item {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Dashboards">Dashboard</div>
            </a>
        </li>

        <!-- Manajemen Kost -->
        <li class="menu-item {{ request()->routeIs('data-kost.*') || request()->routeIs('fasilitas.*') || request()->routeIs('jenis-kost.*') || request()->routeIs('daerah.index') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-buildings"></i>
                <div class="text-truncate" data-i18n="Layouts">Manajemen Kost</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('data-kost.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Without menu">Data Kost</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('fasilitas.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Without navbar">Fasilitas Kost</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('jenis-kost.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Fluid">Jenis Kost</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('daerah.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Fluid">Daerah Kost</div>
                    </a>
                </li>
            </ul>
        </li>



        <!-- Kriteria Topsis -->
        <li class="menu-item {{ request()->routeIs('kriteria.*') || request()->routeIs('bobot.*') || request()->routeIs('sub-kriteria.*') || request()->routeIs('penilaian-alternatif.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                <div class="text-truncate" data-i18n="Front Pages">Kriteria Topsis</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('data-kriteria.index') }}"
                        class="menu-link">
                        <div class="text-truncate" data-i18n="Landing">Data Kriteria</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('sub-kriteria.index') }}"
                        class="menu-link">
                        <div class="text-truncate" data-i18n="Pricing">Sub Kriteria</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/payment-page.html"
                        class="menu-link" target="_blank">
                        <div class="text-truncate" data-i18n="Payment">Sub Kriteria</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/checkout-page.html"
                        class="menu-link" target="_blank">
                        <div class="text-truncate" data-i18n="Checkout">Penilaian Alternatif</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Manajemen User -->
        <li class="menu-item {{ request()->routeIs('user.*') || request()->routeIs('owner.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>

                <div class="text-truncate">
                    Manajemen User
                </div>
            </a>

            <ul class="menu-sub">

                <!-- Semua User -->
                <li class="menu-item">
                    <a href="{{ route('semua-user.index') }}" class="menu-link">
                        <div class="text-truncate">
                            Semua User
                        </div>
                    </a>
                </li>

                <!-- Owner Kost -->
                <li class="menu-item">
                    <a href="{{ route('owner.index') }}" class="menu-link">
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
        <li class="menu-item {{ request()->routeIs('laporan.*') ? 'active open' : '' }}">
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
                @csrf

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
</aside>