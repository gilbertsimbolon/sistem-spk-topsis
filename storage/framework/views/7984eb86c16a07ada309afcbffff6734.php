<?php $__env->startSection('title', 'Kelola Kost Saya | SIPKOST'); ?>

<?php $__env->startSection('content'); ?>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Kost Saya</h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCreate">
            + Tambah Kost
        </button>
    </div>

    <div class="card-body">
        
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $kosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-4 mb-4">
                
                <a href="<?php echo e(route('owner.kost.show', $k->id)); ?>" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm">

                        <?php if($k->foto->count()): ?>
                        <img src="<?php echo e(asset('storage/' . $k->foto->first()->foto)); ?>" class="card-img-top" style="height:180px;object-fit:cover;">
                        <?php else: ?>
                        <img src="<?php echo e(asset('template/paneladmin/assets/img/background/1.jpg')); ?>" class="card-img-top" style="height:180px;object-fit:cover;">
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="mb-1"><?php echo e($k->nama_kost); ?></h5>
                            <small class="text-muted"><?php echo e($k->daerah->name ?? '-'); ?></small>

                            <div class="mt-2">
                                <span class="badge bg-primary">
                                    <?php echo e(optional($k->jenis)->jenis_kost ?? '-'); ?>

                                </span>
                            </div>

                            <h6 class="mt-2">
                                Rp <?php echo e(number_format($k->harga, 0, ',', '.')); ?>

                            </h6>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted">Anda belum memiliki data kost terdaftar.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <form action="<?php echo e(route('owner.kost.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kost</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="text" name="nama_kost" class="form-control mb-2" placeholder="Nama Kost" required>
                    <textarea name="alamat" class="form-control mb-2" placeholder="Alamat" required></textarea>
                    <input type="number" name="harga" class="form-control mb-2" placeholder="Harga" required>

                    <select name="jenis_kost_id" class="form-control mb-2" required>
                        <option value="">-- Pilih Jenis --</option>
                        <?php $__currentLoopData = $jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($j->id); ?>"><?php echo e($j->jenis_kost); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <select name="daerah_kost_id" class="form-control mb-2" required>
                        <option value="">-- Pilih Daerah --</option>
                        <?php $__currentLoopData = $daerah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($d->id); ?>"><?php echo e($d->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <label class="mb-1 fw-bold mt-2">Fasilitas</label><br>
                    <?php $__currentLoopData = $fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="me-2">
                        <input type="checkbox" name="fasilitas[]" value="<?php echo e($f->id); ?>"> <?php echo e($f->keterangan); ?>

                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <hr>

                    <label class="mb-1 fw-bold">Keamanan</label><br>
                    <?php $__currentLoopData = $keamanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="me-2">
                        <input type="checkbox" name="keamanan[]" value="<?php echo e($k->id); ?>"> <?php echo e($k->keterangan); ?>

                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <hr>

                    <label class="mb-1 fw-bold">Kebersihan</label><br>
                    <?php $__currentLoopData = $kebersihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="me-2">
                        <input type="checkbox" name="kebersihan[]" value="<?php echo e($kb->id); ?>"> <?php echo e($kb->keterangan); ?>

                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <hr>

                    <label class="mb-1 fw-bold">Upload Foto</label>
                    <input type="file" name="foto[]" multiple class="form-control" accept="image/*">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/owner/index.blade.php ENDPATH**/ ?>