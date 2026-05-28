

<?php $__env->startSection('title', 'Data Kriteria | SIPKOS'); ?>

<?php $__env->startSection('content'); ?>
<!-- Session -->
<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sukses!</strong> <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> <?php echo e(session('error')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Data Kriteria TOPSIS</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKriteriaModal">Tambah Kriteria</button>
    </div>

    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Tipe</th>
                    <th class="text-center">Bobot</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $criteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key + 1); ?></td>
                    <td><?php echo e($c->kode_kriteria); ?></td>
                    <td><?php echo e($c->nama_kriteria); ?></td>
                    <td>
                        <?php if($c->tipe == 'benefit'): ?>
                            <span class="badge bg-success text-capitalize"><?php echo e($c->tipe); ?></span>
                        <?php else: ?>
                            <span class="badge bg-danger text-capitalize"><?php echo e($c->tipe); ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center"><?php echo e($c->bobot); ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editKriteriaModal<?php echo e($c->id); ?>">Edit</button>

                        <form action="<?php echo e(route('data-kriteria.destroy', $c->id)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus kriteria ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editKriteriaModal<?php echo e($c->id); ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="<?php echo e(route('data-kriteria.update', $c->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Kriteria</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Kode Kriteria</label>
                                        <input type="text" name="kode_kriteria" class="form-control" value="<?php echo e($c->kode_kriteria); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Kriteria</label>
                                        <input type="text" name="nama_kriteria" class="form-control" value="<?php echo e($c->nama_kriteria); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tipe Kriteria</label>
                                        <select name="tipe" class="form-select" required>
                                            <option value="benefit" <?php echo e($c->tipe == 'benefit' ? 'selected' : ''); ?>>Benefit</option>
                                            <option value="cost" <?php echo e($c->tipe == 'cost' ? 'selected' : ''); ?>>Cost</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Bobot Kriteria</label>
                                        <input type="number" step="any" name="bobot" class="form-control" value="<?php echo e($c->bobot); ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- note -->
        <div class="mt-3">
            <small class="text-muted d-block">
                <strong>Keterangan Skala Bobot:</strong>
            </small>
            <small class="text-muted d-block">
                1 = Tidak Penting, 2 = Kurang Penting, 3 = Cukup Penting, 4 = Penting, 5 = Sangat Penting
            </small>
        </div>
    </div>
</div>

<div class="modal fade" id="addKriteriaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo e(route('data-kriteria.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode Kriteria</label>
                        <input type="text" name="kode_kriteria" class="form-control" placeholder="Contoh: C1, C2, C3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Kriteria</label>
                        <input type="text" name="nama_kriteria" class="form-control" placeholder="Contoh: Harga, Jarak, Fasilitas" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipe Kriteria</label>
                        <select name="tipe" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Tipe --</option>
                            <option value="benefit">Benefit</option>
                            <option value="cost">Cost</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bobot Kriteria</label>
                        <input type="number" step="any" name="bobot" class="form-control" placeholder="1-5" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/admin/pages/topsis/data-kriteria.blade.php ENDPATH**/ ?>