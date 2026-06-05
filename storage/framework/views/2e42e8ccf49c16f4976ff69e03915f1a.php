

<?php $__env->startSection('title', 'Detail Kost | SIPKOST'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="mb-3">
    <a href="<?php echo e(route('kost.index')); ?>" class="btn btn-secondary btn-sm"><i class="bx bx-arrow-back"></i> Kembali</a>
</div>

<div class="row">
    
    <div class="col-md-8">
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fw-bold mb-0">
                        <?php echo e($kost->nama_kost); ?>

                    </h3>
                    
                    
                    <div class="d-flex gap-2">
                        <button class="btn btn-warning btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#modalEditKost">
                            <i class="bx bx-edit-alt"></i> Edit Kost
                        </button>

                        <form action="<?php echo e(route('kost.destroy', $kost->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus seluruh data kost ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm fw-semibold">
                                <i class="bx bx-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>

                
                <?php if($kost->foto->count()): ?>
                <div id="kostCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner rounded overflow-hidden">
                        <?php $__currentLoopData = $kost->foto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                            <img src="<?php echo e(asset('storage/' . $foto->foto)); ?>" class="d-block w-100" style="height:500px;object-fit:cover;">
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#kostCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#kostCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                
                <div class="d-flex flex-wrap gap-3">
                    <?php $__currentLoopData = $kost->foto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="position-relative d-inline-block">
                        <button type="button" data-bs-target="#kostCarousel" data-bs-slide-to="<?php echo e($key); ?>" class="border-0 bg-transparent p-0">
                            <img src="<?php echo e(asset('storage/' . $foto->foto)); ?>" class="rounded border shadow-sm" style="width:120px;height:90px;object-fit:cover;cursor:pointer;">
                        </button>

                        
                        <form action="<?php echo e(route('kost-foto.destroy', $foto->id)); ?>" method="POST" class="position-absolute top-0 end-0 m-1" onsubmit="event.stopPropagation(); return confirm('Hapus foto ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width:24px;height:24px;padding:0;">
                                &times;
                            </button>
                        </form>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                <img src="<?php echo e(asset('template/paneladmin/assets/img/background/1.jpg')); ?>" class="img-fluid rounded" style="width:100%;height:500px;object-fit:cover;">
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="col-md-4">
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Informasi Kost</h5>

                <div class="mb-4">
                    <small class="text-muted d-block mb-1">Harga</small>
                    <h3 class="fw-bold text-primary mb-0">
                        Rp <?php echo e(number_format($kost->harga, 0, ',', '.')); ?>

                    </h3>
                </div>

                <div class="mb-4">
                    <small class="text-muted d-block mb-1">Jenis Kost</small>
                    <span class="badge bg-primary px-3 py-2">
                        <?php echo e(optional($kost->jenis)->jenis_kost); ?>

                    </span>
                </div>

                <div class="mb-4">
                    <small class="text-muted d-block mb-1">Daerah</small>
                    <p class="mb-0 fw-semibold"><?php echo e(optional($kost->daerah)->name); ?></p>
                </div>

                <div class="mb-4">
                    <small class="text-muted d-block mb-1">Alamat</small>
                    <p class="mb-0"><?php echo e($kost->alamat); ?></p>
                </div>

                <div class="mb-3">
                    <small class="text-muted d-block mb-2">Fasilitas</small>
                    <?php $__empty_1 = true; $__currentLoopData = $kost->fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <span class="badge bg-success mb-1 me-1 px-3 py-2"><?php echo e($f->keterangan); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <span class="text-muted text-xs d-block">Tidak ada fasilitas</span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <small class="text-muted d-block mb-2">Keamanan</small>
                    <?php $__empty_1 = true; $__currentLoopData = $kost->keamanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $km): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <span class="badge bg-success mb-1 me-1 px-3 py-2"><?php echo e($km->keterangan); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <span class="text-muted text-xs d-block">Tidak ada sistem keamanan</span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <small class="text-muted d-block mb-2">Kebersihan</small>
                    <?php $__empty_1 = true; $__currentLoopData = $kost->kebersihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <span class="badge bg-success mb-1 me-1 px-3 py-2"><?php echo e($kb->keterangan); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <span class="text-muted text-xs d-block">Tidak ada info kebersihan</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Upload Foto Baru</h5>
                <form action="<?php echo e(route('kost-foto.store', $kost->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="file" name="foto[]" multiple required class="form-control mb-3">
                    <button type="submit" class="btn btn-primary w-100">Upload Foto</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEditKost" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo e(route('kost.update', $kost->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Data Kost</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Kost</label>
                        <input type="text" name="nama_kost" value="<?php echo e($kost->nama_kost); ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required><?php echo e($kost->alamat); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga (Rp)</label>
                        <input type="number" name="harga" value="<?php echo e($kost->harga); ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Kost</label>
                        <select name="jenis_kost_id" class="form-select" required>
                            <?php $__currentLoopData = $jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($j->id); ?>" <?php echo e($kost->jenis_kost_id == $j->id ? 'selected' : ''); ?>>
                                <?php echo e($j->jenis_kost); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Daerah Kost</label>
                        <select name="daerah_kost_id" class="form-select" required>
                            <?php $__currentLoopData = $daerah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($d->id); ?>" <?php echo e($kost->daerah_kost_id == $d->id ? 'selected' : ''); ?>>
                                <?php echo e($d->name); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label fw-semibold d-block">Fasilitas</label>
                        <?php $__currentLoopData = $fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-check form-check-inline me-3">
                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="<?php echo e($f->id); ?>" id="f-<?php echo e($f->id); ?>" <?php echo e($kost->fasilitas->contains($f->id) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="f-<?php echo e($f->id); ?>"><?php echo e($f->keterangan); ?></label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold d-block">Keamanan</label>
                        <?php $__currentLoopData = $keamanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-check form-check-inline me-3">
                            <input class="form-check-input" type="checkbox" name="keamanan[]" value="<?php echo e($dk->id); ?>" id="k-<?php echo e($dk->id); ?>" <?php echo e($kost->keamanan->contains($dk->id) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="k-<?php echo e($dk->id); ?>"><?php echo e($dk->keterangan); ?></label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold d-block">Kebersihan</label>
                        <?php $__currentLoopData = $kebersihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-check form-check-inline me-3">
                            <input class="form-check-input" type="checkbox" name="kebersihan[]" value="<?php echo e($kb->id); ?>" id="kb-<?php echo e($kb->id); ?>" <?php echo e($kost->kebersihan->contains($kb->id) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="kb-<?php echo e($kb->id); ?>"><?php echo e($kb->keterangan); ?></label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/owner/show.blade.php ENDPATH**/ ?>