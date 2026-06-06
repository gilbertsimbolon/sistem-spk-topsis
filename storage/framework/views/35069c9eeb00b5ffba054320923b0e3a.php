<?php $__env->startSection('title', 'Detail Kost | ' . $kost->nama_kost); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">

    
    <div class="mb-4">
        <a href="<?php echo e(route('dashboard.index')); ?>" class="text-decoration-none text-muted small">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="row g-4">
        
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm overflow-hidden mb-4">
                <div class="card-body p-3">
                    <h3 class="fw-bold text-dark mb-3"><?php echo e($kost->nama_kost); ?></h3>

                    
                    <?php if($kost->foto->count()): ?>
                        <div id="kostUserCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                            <div class="carousel-inner rounded overflow-hidden shadow-sm">
                                <?php $__currentLoopData = $kost->foto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                                        <img src="<?php echo e(asset('storage/' . $foto->foto)); ?>" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="Foto Kost">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#kostUserCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#kostUserCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        </div>

                        
                        <div class="d-flex flex-wrap gap-2">
                            <?php $__currentLoopData = $kost->foto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button type="button" data-bs-target="#kostUserCarousel" data-bs-slide-to="<?php echo e($key); ?>" class="border-0 bg-transparent p-0">
                                    <img src="<?php echo e(asset('storage/' . $foto->foto)); ?>" class="rounded border" style="width: 90px; height: 65px; object-fit: cover; cursor: pointer;">
                                </button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        
                        <img src="<?php echo e(asset('template/paneladmin/assets/img/background/1.jpg')); ?>" class="img-fluid rounded w-100 shadow-sm" style="height: 450px; object-fit: cover;" alt="Default Image">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm border-top border-primary border-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-4">Informasi Sewa</h5>

                    <div class="mb-4">
                        <small class="text-muted d-block mb-1">Harga Sewa</small>
                        <h3 class="fw-bold text-primary mb-0">
                            Rp <?php echo e(number_format($kost->harga, 0, ',', '.')); ?><span class="fs-6 fw-normal text-muted"> / bulan</span>
                        </h3>
                    </div>

                    <div class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                        <span class="text-muted small">Jenis Kost</span>
                        <span class="badge bg-primary px-2.5 py-1.5 shadow-sm">
                            <?php echo e($kost->jenis->jenis_kost ?? 'Campur'); ?>

                        </span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                        <span class="text-muted small">Daerah</span>
                        <span class="fw-semibold text-dark small"><?php echo e($kost->daerah->name ?? 'Tidak Ada'); ?></span>
                    </div>

                    <div class="mb-4">
                        <small class="text-muted d-block mb-1">Alamat Lengkap</small>
                        <p class="text-dark small mb-0"><i class="bi bi-geo-alt-fill text-danger me-1"></i><?php echo e($kost->alamat); ?></p>
                    </div>

                    
                    <?php if($kost->owner && $kost->owner->no_hp): ?>
                        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $kost->owner->no_hp)); ?>?text=Halo,%20saya%20tertarik%20dengan%20Kost%20<?php echo e(urlencode($kost->nama_kost)); ?>%20yang%20ada%20di%20SIPKOST."
                           target="_blank"
                           class="btn btn-success w-100 py-2.5 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-whatsapp fs-5"></i> Hubungi Pemilik Kost
                        </a>
                    <?php else: ?>
                        <button class="btn btn-secondary w-100 py-2.5 fw-bold" disabled>
                            <i class="bi bi-telephone-x me-2"></i> Kontak Tidak Tersedia
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-3">Fasilitas & Layanan</h5>

                    <div class="mb-3">
                        <small class="text-muted d-block mb-2 fw-semibold">Fasilitas Kamar/Bersama</small>
                        <?php $__empty_1 = true; $__currentLoopData = $kost->fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <span class="badge bg-light text-dark border mb-1 me-1 px-3 py-2 small"><?php echo e($f->keterangan); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <span class="text-muted small d-block italic">Tidak ada fasilitas terdaftar</span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block mb-2 fw-semibold">Sistem Keamanan</small>
                        <?php $__empty_1 = true; $__currentLoopData = $kost->keamanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $km): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <span class="badge bg-light text-dark border mb-1 me-1 px-3 py-2 small"><?php echo e($km->keterangan); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <span class="text-muted small d-block italic">Tidak ada info keamanan</span>
                        <?php endif; ?>
                    </div>

                    <div>
                        <small class="text-muted d-block mb-2 fw-semibold">Kebersihan</small>
                        <?php $__empty_1 = true; $__currentLoopData = $kost->kebersihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <span class="badge bg-light text-dark border mb-1 me-1 px-3 py-2 small"><?php echo e($kb->keterangan); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <span class="text-muted small d-block italic">Tidak ada info kebersihan</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/user/pages/detail-kost.blade.php ENDPATH**/ ?>