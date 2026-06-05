

<?php $__env->startSection('title', 'Penilaian Alternatif | SIPKOS'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark">Matriks Keputusan (Otomatis)</h5>
        <span class="badge bg-success px-3 py-2">✨ Terisi Otomatis dari Data Kos</span>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%" rowspan="2" class="align-middle">#</th>
                        <th rowspan="2" class="align-middle text-start">Nama Kost</th>
                        <th colspan="<?php echo e($totalKriteria); ?>" class="text-center">Kriteria (Nilai Bobot TOPSIS 1-5)</th>
                    </tr>
                    <tr>
                        <?php $__currentLoopData = $criterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th><?php echo e($c->nama_kriteria); ?></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $kosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key + 1); ?></td>
                        <td class="text-start"><span class="fw-bold text-dark"><?php echo e($k->nama_kost); ?></span></td>
                        
                        <?php $__currentLoopData = $criterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $dataMatriks = $k->matriks[$c->id] ?? ['bobot' => 1, 'riil' => 0];
                            ?>
                            <td>
                                <span class="badge bg-primary px-3 py-2 fs-6" 
                                      data-bs-toggle="tooltip" 
                                      data-bs-placement="top"
                                      title="Nilai Riil: <?php echo e($dataMatriks['riil']); ?>">
                                    <?php echo e($dataMatriks['bobot']); ?>

                                </span>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/admin/pages/topsis/penilaian-alternatif.blade.php ENDPATH**/ ?>