<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?php echo $__env->yieldContent('title'); ?></title>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

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
    <link rel="stylesheet" href="<?php echo e(asset('css/index.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('template/landingpage/assets/css/LineIcons.2.0.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('template/landingpage/assets/css/tiny-slider.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('template/landingpage/assets/css/animate.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('template/landingpage/assets/css/main.css')); ?>" />

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Helpers -->
    <script src="<?php echo e(asset('template/paneladmin/assets/vendor/js/helpers.js')); ?>"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="<?php echo e(asset('template/paneladmin/assets/js/config.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>

<body>
    <?php if(!isset($hideLayout) || !$hideLayout): ?>
        <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>

    
        <?php echo $__env->yieldContent('content'); ?>
    

    <?php if(!isset($hideLayout) || !$hideLayout): ?>
        <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>

    <script src="<?php echo e(asset('template/paneladmin/assets/vendor/libs/jquery/jquery.js')); ?>"></script>

    <script src="<?php echo e(asset('template/paneladmin/assets/vendor/libs/popper/popper.js')); ?>"></script>
    <script src="<?php echo e(asset('template/paneladmin/assets/vendor/js/bootstrap.js')); ?>"></script>

    <script src="<?php echo e(asset('template/paneladmin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>

    <script src="<?php echo e(asset('template/paneladmin/assets/vendor/js/menu.js')); ?>"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php echo e(asset('template/paneladmin/assets/vendor/libs/apex-charts/apexcharts.js')); ?>"></script>

    <!-- Main JS -->
    <script src="<?php echo e(asset('template/paneladmin/assets/js/main.js')); ?>"></script>


    <!-- Page JS -->
    <script src="<?php echo e(asset('template/paneladmin/assets/js/dashboards-analytics.js')); ?>"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Swiper JS -->
</body>

</html>
<?php /**PATH C:\laravel\spk-topsis\resources\views/layouts/app.blade.php ENDPATH**/ ?>