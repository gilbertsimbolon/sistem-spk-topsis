<!doctype html>

<html lang="en" class="layout-menu-fixed layout-compact" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?php echo $__env->yieldContent('title'); ?></title>

    <meta name="description" content="" />

    <!-- Website Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('img/logo-unima.png')); ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo e(asset('template/paneladmin/assets/vendor/fonts/iconify-icons.css')); ?>" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="<?php echo e(asset('template/paneladmin/assets/vendor/css/core.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('template/paneladmin/assets/css/demo.css')); ?>" />

    <!-- Vendors CSS -->

    <link rel="stylesheet"
        href="<?php echo e(asset('template/paneladmin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')); ?>" />

    <!-- endbuild -->

    <link rel="stylesheet" href="<?php echo e(asset('template/paneladmin/assets/vendor/libs/apex-charts/apex-charts.css')); ?>" />

    <!-- Page CSS -->
    

    <!-- Helpers -->
    <script src="<?php echo e(asset('template/paneladmin/assets/vendor/js/helpers.js')); ?>"></script>

    <script src="<?php echo e(asset('template/paneladmin/assets/js/config.js')); ?>"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <?php echo $__env->make('admin.layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="layout-page">

                <?php echo $__env->make('admin.layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <div class="content-wrapper">

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                    <?php echo $__env->make('admin.layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    

    <!-- Core JS -->
    <script src="<?php echo e(asset('template/paneladmin/assets/vendor/libs/jquery/jquery.js')); ?>"></script>

    <script src="<?php echo e(asset('template/paneladmin/assets/vendor/libs/popper/popper.js')); ?>"></script>
    <script src="<?php echo e(asset('template/paneladmin/assets/vendor/js/bootstrap.js')); ?>"></script>

    <script src="<?php echo e(asset('template/paneladmin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>

    <script src="<?php echo e(asset('template/paneladmin/assets/vendor/js/menu.js')); ?>"></script>

    <!-- Vendors JS -->
    <script src="<?php echo e(asset('template/paneladmin/assets/vendor/libs/apex-charts/apexcharts.js')); ?>"></script>

    <!-- Main JS -->
    <script src="<?php echo e(asset('template/paneladmin/assets/js/main.js')); ?>"></script>

    <!-- Page JS -->
    <script src="<?php echo e(asset('template/paneladmin/assets/js/dashboards-analytics.js')); ?>"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
<?php /**PATH C:\laravel\spk-topsis\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>