

<?php $__env->startSection('title', 'Keamanan Kost'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Keamanan Kost</h5>
        <!-- Button Tambah Keamanan -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKeamananModal">Tambah Keamanan</button>
    </div>

    <div class="card-body">
        <!-- Tabel Keamanan -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Keamanan</th>
                    <th>Bobot</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $keamanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key + 1); ?></td>
                    <td><?php echo e($f->keterangan); ?></td>
                    <td><?php echo e($f->bobot); ?></td>
                    <td>
                        <!-- Button Edit -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editKeamananModal<?php echo e($f->id); ?>">Edit</button>

                        <!-- Form Hapus -->
                        <form action="<?php echo e(route('keamanan.destroy', $f->id)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editKeamananModal<?php echo e($f->id); ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="<?php echo e(route('keamanan.update', $f->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Keamanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="keterangan" class="form-control" value="<?php echo e($f->keterangan); ?>" required>
                                </div>
                                <div class="modal-body">
                                    <input type="integer" name="bobot" class="form-control" value="<?php echo e($f->bobot); ?>" required>
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
    </div>
</div>

<!-- Modal Tambah Keamanan -->
<div class="modal fade" id="addKeamananModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo e(route('keamanan.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Keamanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="keterangan" class="form-control" placeholder="Nama Keamanan" required>
                </div>
                <div class="modal-body">
                    <input type="integer" name="bobot" class="form-control" placeholder="Nilai Bobot (1-5)" required>
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

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/admin/pages/manajemenkost/keamanan.blade.php ENDPATH**/ ?>