<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">

    
    <div class="d-flex align-items-center">
        <a class="navbar-brand d-flex align-items-center gap-2 m-0" href="/">
            <img src="<?php echo e(asset('img/logo-unima.svg')); ?>" alt="Logo" style="width: 35px; height: 35px; object-fit: contain;" />
            <span class="fw-bold mb-0 text-dark fs-5 d-none d-sm-inline">Sistem Pemilihan Kost</span>
        </a>
    </div>

    
    <div class="navbar-nav-right d-none d-xl-flex align-items-center justify-content-end flex-grow-1"
        id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow d-flex align-items-center gap-1 text-dark fw-semibold"
                    href="javascript:void(0);" data-bs-toggle="dropdown">
                    <span><?php echo e(Auth::user()->name); ?></span>
                    <i class="bx bx-chevron-down small text-muted"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                    <li>
                        <div class="dropdown-item py-2">
                            <h6 class="mb-0 fw-bold text-dark"><?php echo e(Auth::user()->name); ?></h6>
                            <small class="text-muted text-capitalize" style="font-size: 11px;"><?php echo e(Auth::user()->role); ?></small>
                        </div>
                    </li>
                    <li><div class="dropdown-divider my-1"></div></li>
                    <li>
                        <a class="dropdown-item py-2" href="<?php echo e(route('profile.user.edit')); ?>">
                            <i class="bx bx-user me-2 text-secondary"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li><div class="dropdown-divider my-1"></div></li>
                    <li>
                        <form action="<?php echo e(route('logout')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item py-2">
                                <i class="bx bx-power-off me-2 text-danger"></i>
                                <span class="text-danger fw-semibold">Log Out</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    
    <div class="d-flex align-items-center ms-auto d-xl-none gap-2">

        
        <div class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow p-2 text-dark" href="javascript:void(0);" data-bs-toggle="dropdown">
                
                <i class="bx bx-user-circle fs-3"></i>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                <li>
                    <div class="dropdown-item py-2">
                        <h6 class="mb-0 fw-bold text-dark text-truncate" style="max-width: 150px;"><?php echo e(Auth::user()->name); ?></h6>
                        <small class="text-muted text-capitalize" style="font-size: 11px;"><?php echo e(Auth::user()->role); ?></small>
                    </div>
                </li>
                <li><div class="dropdown-divider my-1"></div></li>
                <li>
                    <a class="dropdown-item py-2" href="<?php echo e(route('profile.user.edit')); ?>">
                        <i class="bx bx-user me-2 text-secondary"></i>
                        <span>My Profile</span>
                    </a>
                </li>
                <li><div class="dropdown-divider my-1"></div></li>
                <li>
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="dropdown-item py-2">
                            <i class="bx bx-power-off me-2 text-danger"></i>
                            <span class="text-danger fw-semibold">Log Out</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>

</nav>
<?php /**PATH C:\laravel\spk-topsis\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>