<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">

    
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 d-xl-none">
        <a class="nav-item nav-link px-0" href="javascript:void(0)">
            <i class="bx bx-menu fs-3"></i>
        </a>
    </div>

    
    <div class="navbar-nav-right d-flex align-items-center justify-content-end flex-grow-1"
        id="navbar-collapse">

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            
            <li class="nav-item navbar-dropdown dropdown-user dropdown">

                <a class="nav-link dropdown-toggle hide-arrow d-flex align-items-center"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">

                    
                    <div class="text-end">

                        <h6 class="mb-0 fw-semibold">
                            <?php echo e(Auth::user()->name); ?>

                        </h6>

                        <small class="text-muted text-capitalize">
                            <?php echo e(Auth::user()->role); ?>

                        </small>

                    </div>

                </a>

                
                <ul class="dropdown-menu dropdown-menu-end">

                    
                    <li>
                        <div class="dropdown-item">

                            <div>

                                <h6 class="mb-0">
                                    <?php echo e(Auth::user()->name); ?>

                                </h6>

                                <small class="text-muted text-capitalize">
                                    <?php echo e(Auth::user()->role); ?>

                                </small>

                            </div>

                        </div>
                    </li>

                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>

                    
                    <li>
                        <a class="dropdown-item" href="#">

                            <i class="bx bx-user me-2"></i>

                            <span>My Profile</span>

                        </a>
                    </li>

                    
                    <li>
                        <a class="dropdown-item" href="#">

                            <i class="bx bx-cog me-2"></i>

                            <span>Settings</span>

                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>

                    
                    <li>

                        <form action="<?php echo e(route('logout')); ?>" method="POST">

                            <?php echo csrf_field(); ?>

                            <button type="submit" class="dropdown-item">

                                <i class="bx bx-power-off me-2"></i>

                                <span>Log Out</span>

                            </button>

                        </form>

                    </li>

                </ul>

            </li>

        </ul>

    </div>

</nav><?php /**PATH C:\laravel\spk-topsis\resources\views/admin/layouts/navbar.blade.php ENDPATH**/ ?>