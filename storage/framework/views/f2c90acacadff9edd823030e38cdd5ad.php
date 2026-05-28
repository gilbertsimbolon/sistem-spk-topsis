

<?php $__env->startSection('title', 'Hasil Rekomendasi TOPSIS | SIPKOS'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Hasil Perangkingan Rekomendasi Kost (TOPSIS)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th width="80">Rank</th>
                            <th>Nama Kost</th>
                            <th>Harga Sewa</th>
                            <th>Jarak Ideal (D+)</th>
                            <th>Jarak Terburuk (D-)</th>
                            <th>Nilai Preferensi (V)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $hasilAkhir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $hasil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php if($index == 0): ?>
                                        <span class="badge bg-warning text-dark fs-6 shadow-sm">
                                            <i class="bi bi-trophy-fill text-danger me-1"></i> 1
                                        </span>
                                    <?php elseif($index == 1): ?>
                                        <span class="badge bg-light text-dark border fs-6 shadow-sm">
                                            <i class="bi bi-medal-fill text-secondary me-1"></i> 2
                                        </span>
                                    <?php elseif($index == 2): ?>
                                        <span class="badge bg-light text-dark border fs-6 shadow-sm">
                                            <i class="bi bi-medal-fill text-warning me-1"></i> 3
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary text-white fs-6 ps-3 pe-3">
                                            <?php echo e($index + 1); ?>

                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="fw-bold text-dark"><?php echo e($hasil['nama_kost']); ?></span></td>
                                <td>Rp <?php echo e(number_format($hasil['harga'], 0, ',', '.')); ?></td>
                                <td><?php echo e(number_format($hasil['d_positif'], 4)); ?></td>
                                <td><?php echo e(number_format($hasil['d_negatif'], 4)); ?></td>
                                <td>
                                    <span class="fw-bold text-dark fs-5"><?php echo e(number_format($hasil['skor_v'], 4)); ?></span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Matriks Keputusan Awal (X)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle mb-0">
                    <thead>
                        <tr class="text-center">
                            <th>Alternatif / Kost</th>
                            <?php $__currentLoopData = $criterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th>
                                    <?php echo e($c->nama_kriteria); ?>

                                    <small class="d-block text-muted text-capitalize">(<?php echo e($c->tipe); ?>)</small>
                                </th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $kosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="fw-bold text-dark"><?php echo e($k->nama_kost); ?></td>
                                <?php $__currentLoopData = $criterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td class="text-center">
                                        <?php echo e(isset($matriksX[$k->id][$c->id]) ? $matriksX[$k->id][$c->id] : 0); ?>

                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/admin/pages/topsis/perhitungan.blade.php ENDPATH**/ ?>