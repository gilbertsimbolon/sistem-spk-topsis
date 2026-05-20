<nav class="navbar navbar-expand-lg fixed-top" style="background-color:#56B6C6;">

    <div class="container-fluid">

        <!-- navbar bagian kiri -->
        <div class="d-flex align-items-center gap-2">

            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <img src="{{ asset('img/logo-unima.svg') }}" style="width:40px;height:40px;" />
                <span class="fw-bold d-none d-md-inline text-dark fs-3">
                    Sistem Pemilihan Kost
                </span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon me-2"></span>
            </button>

        </div>

        <!-- navbar bagian kanan -->
        <div class="collapse navbar-collapse" id="navbarContent">

            <div class="ms-auto d-flex flex-column flex-lg-row align-items-lg-center gap-2 text-end">

                <!-- menu di tampilan dashboard -->
                <div class="dropdown d-none d-lg-block">
                    <a class="fw-semibold text-dark text-decoration-none dropdown-toggle" href="#"
                        data-bs-toggle="dropdown">
                        {{ Auth::user()->name}}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

                <!-- menu di halaman mobile -->
                <form class="d-lg-none" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm w-100">
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </div>
</nav>
