<div class="row g-4">
    <?php $__empty_1 = true; $__currentLoopData = $kosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            
            <a href="<?php echo e(route('dashboard.kost.show', $kos->id)); ?>" class="text-decoration-none text-dark d-block h-100">
                <div class="card border-0 shadow-sm h-100 kost-card">
                    <div class="position-relative">
                        <img src="<?php echo e($kos->foto->isNotEmpty() ? asset('storage/' . $kos->foto->first()->foto) : asset('template/paneladmin/assets/img/background/1.jpg')); ?>"
                             class="card-img-top kost-img" alt="<?php echo e($kos->nama_kost); ?>">
                        <span class="badge bg-success position-absolute top-0 start-0 m-2 px-2.5 py-1.5 shadow-sm">
                            <?php echo e($kos->jenis->jenis_kost ?? 'Campur'); ?>

                        </span>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h6 class="fw-bold text-dark text-truncate mb-1" title="<?php echo e($kos->nama_kost); ?>"><?php echo e($kos->nama_kost); ?></h6>
                            <small class="text-muted d-block mb-2">
                                <i class="bi bi-geo-alt me-1"></i><?php echo e($kos->daerah->name ?? 'Tidak Ada Daerah'); ?>

                            </small>
                            <p class="text-secondary small text-truncate mb-3" title="<?php echo e($kos->fasilitas->implode('keterangan', ' • ')); ?>">
                                <?php echo e($kos->fasilitas->isEmpty() ? 'Fasilitas Standar' : $kos->fasilitas->implode('keterangan', ' • ')); ?>

                            </p>
                        </div>
                        <h6 class="text-primary fw-bold mb-0">Rp <?php echo e(number_format($kos->harga, 0, ',', '.')); ?><span class="text-muted fw-normal small">/bln</span></h6>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 text-center py-5">
            <i class="bi bi-house-x text-muted" style="font-size: 3rem;"></i>
            <p class="text-muted mt-2 mb-0">Tidak ada kamar kost yang cocok dengan kriteria filter Anda.</p>
        </div>
    <?php endif; ?>
</div>

<div class="d-flex justify-content-center mt-5 pagination-ajax">
    <?php echo e($kosts->links()); ?>

</div><?php /**PATH C:\laravel\spk-topsis\resources\views/user/partials/kost_list.blade.php ENDPATH**/ ?>