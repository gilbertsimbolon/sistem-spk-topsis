<?php $__env->startSection('title', 'Statistik Sistem | SIPKOS'); ?>

<?php $__env->startSection('content'); ?>
    <h4 class="fw-bold mb-4">Statistik Sistem SIPKOS</h4>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx bx-buildings fs-3"></i></span>
                    </div>
                    <span class="d-block mb-1 text-muted">Total Kost Terdaftar</span>
                    <h3 class="card-title mb-0"><?php echo e($totalKost); ?></h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-label-success"><i class="bx bx-user-pin fs-3"></i></span>
                    </div>
                    <span class="d-block mb-1 text-muted">Total Pemilik (Owner)</span>
                    <h3 class="card-title mb-0"><?php echo e($totalOwner); ?></h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-label-info"><i class="bx bx-group fs-3"></i></span>
                    </div>
                    <span class="d-block mb-1 text-muted">Total Pencari Kost</span>
                    <h3 class="card-title mb-0"><?php echo e($totalUser); ?></h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-label-warning"><i class="bx bx-money fs-3"></i></span>
                    </div>
                    <span class="d-block mb-1 text-muted">Rata-rata Harga Sewa</span>
                    <h3 class="card-title mb-0 text-truncate">Rp <?php echo e(number_format($rataHarga, 0, ',', '.')); ?></h3>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/admin/pages/laporan/statistik.blade.php ENDPATH**/ ?>