<?php $__env->startSection('title', 'Laporan Data Kost | SIPKOS'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Laporan Seluruh Data Kost</h5>
            <button class="btn btn-primary btn-sm" onclick="window.print()">
                <i class="bi bi-printer me-1"></i> Cetak Laporan
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kost</th>
                            <th>Pemilik</th>
                            <th>Daerah</th>
                            <th>Jenis</th>
                            <th>Harga Sewa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $kosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($index + 1); ?></td>
                                <td class="fw-bold"><?php echo e($kost->nama_kost); ?></td>
                                <td><?php echo e(optional($kost->user)->name ?? 'Tidak Ada Akun'); ?></td>
                                <td><?php echo e(optional($kost->daerah)->name); ?></td>
                                <td><span class="badge bg-label-info"><?php echo e(optional($kost->jenis)->jenis_kost); ?></span></td>
                                <td class="text-success fw-semibold">Rp <?php echo e(number_format($kost->harga, 0, ',', '.')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada data kost yang terdaftar.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/admin/pages/laporan/data-kost.blade.php ENDPATH**/ ?>