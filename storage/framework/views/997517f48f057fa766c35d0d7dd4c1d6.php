

<?php $__env->startSection('title', 'Penilaian Alternatif | SIPKOS'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5>Penilaian Alternatif (Data Kost)</h5>
    </div>

    <div class="card-body">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kost</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $kosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key + 1); ?></td>
                    <td><span class="fw-bold"><?php echo e($k->nama_kost); ?></span></td>
                    <td>
                        <?php $count = $k->penilaianAlternatif->count(); ?>
                        <?php if($count >= $totalKriteria): ?>
                            <span class="badge bg-success">Lengkap</span>
                        <?php else: ?>
                            <span class="badge bg-warning">Belum Lengkap (<?php echo e($count); ?>/<?php echo e($totalKriteria); ?>)</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#penilaianModal<?php echo e($k->id); ?>">
                            Input Nilai
                        </button>
                    </td>
                </tr>

                <div class="modal fade" id="penilaianModal<?php echo e($k->id); ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form action="<?php echo e(route('penilaian-alternatif.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="kost_id" value="<?php echo e($k->id); ?>">
                            
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Penilaian: <?php echo e($k->nama_kost); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <?php $__currentLoopData = $criterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold"><?php echo e($c->nama_kriteria); ?></label>
                                                
                                                
                                                <?php 
                                                    $currentVal = $k->penilaianAlternatif->where('criteria_id', $c->id)->first()?->nilai; 
                                                ?>

                                                <?php if($c->subCriteria->count() > 0): ?>
                                                    <select name="nilai[<?php echo e($c->id); ?>]" class="form-select" required>
                                                        <option value="" disabled selected>-- Pilih --</option>
                                                        <?php $__currentLoopData = $c->subCriteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($sub->nilai); ?>" <?php echo e($currentVal == $sub->nilai ? 'selected' : ''); ?>>
                                                                <?php echo e($sub->nama_sub_kriteria); ?> (<?php echo e($sub->nilai); ?>)
                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                <?php else: ?>
                                                    <input type="number" step="any" name="nilai[<?php echo e($c->id); ?>]" class="form-control" value="<?php echo e($currentVal); ?>" required>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/admin/pages/topsis/penilaian-alternatif.blade.php ENDPATH**/ ?>