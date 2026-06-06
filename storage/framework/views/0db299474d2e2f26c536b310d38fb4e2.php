<div class="row g-4">
    <?php $__currentLoopData = $kosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <a class="card border-0 shadow-sm h-100 text-decoration-none text-dark" href="<?php echo e(route('login')); ?>">
                <div class="position-relative">
                    <img src="<?php echo e($kos->foto->isNotEmpty() ? asset('storage/' . $kos->foto->first()->foto) : asset('template/paneladmin/assets/img/background/1.jpg')); ?>"
                         class="card-img-top kost-img" style="height: 200px; object-fit: cover;" alt="kost">
                    <span class="badge bg-success position-absolute top-0 start-0 m-2">
                        <?php echo e($kos->jenis->jenis_kost ?? 'Tidak Ada Jenis'); ?>

                    </span>
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h6 class="fw-bold mb-1 text-truncate"><?php echo e($kos->nama_kost); ?></h6>
                        <small class="text-muted d-block mb-2">
                            <?php echo e($kos->daerah->name ?? 'Tidak Ada Daerah'); ?>

                        </small>
                        <p class="text-muted small text-truncate mb-3">
                            <?php echo e($kos->fasilitas->isEmpty() ? 'Tidak Ada Fasilitas' : $kos->fasilitas->implode('keterangan', ', ')); ?>

                        </p>
                    </div>
                    <h6 class="text-primary fw-bold mb-0">Rp <?php echo e(number_format($kos->harga, 0, ',', '.')); ?><span class="text-muted small fw-normal">/bln</span></h6>
                </div>
            </a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="d-flex justify-content-center mt-5 pagination-ajax">
    <?php echo e($kosts->links()); ?>

</div>
<?php /**PATH C:\laravel\spk-topsis\resources\views/partials/kost_list.blade.php ENDPATH**/ ?>