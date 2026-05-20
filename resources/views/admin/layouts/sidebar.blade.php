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

        <!-- Dashoard -->
        <li class="menu-item active open">
            <a href="javascript:void(0);" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Dashboards">Dashboard</div>
            </a>
        </li>

        <!-- Manajemen Kost -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
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
                {{-- <li class="menu-item">
                    <a href="{{ route('foto-kost.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Container">Foto Kost</div>
                    </a>
                </li> --}}
            </ul>
        </li>

        <!-- Kriteria Topsis -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-store"></i>
                <div class="text-truncate" data-i18n="Front Pages">Kriteria Topsis</div>
                <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/landing-page.html"
                        class="menu-link" target="_blank">
                        <div class="text-truncate" data-i18n="Landing">Data Kriteria</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/pricing-page.html"
                        class="menu-link" target="_blank">
                        <div class="text-truncate" data-i18n="Pricing">Bobot Kriteria</div>
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
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-store"></i>
                <div class="text-truncate" data-i18n="Front Pages">Manajemen User</div>
                <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/landing-page.html"
                        class="menu-link" target="_blank">
                        <div class="text-truncate" data-i18n="Landing">Data User</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/pricing-page.html"
                        class="menu-link" target="_blank">
                        <div class="text-truncate" data-i18n="Pricing">Admin</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Laporan -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-store"></i>
                <div class="text-truncate" data-i18n="Front Pages">Laporan Ranking</div>
                <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
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
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Logout</span>
        </li>
    </ul>
</aside>
