

<?php $__env->startSection('title', 'Detail Kost | SIPKOST'); ?>

<?php $__env->startSection('content'); ?>

<div class="row">

    
    <div class="col-md-8">

        <div class="card mb-4 border-0 shadow-sm">

            <div class="card-body">

                <h3 class="fw-bold mb-3">
                    <?php echo e($kost->nama_kost); ?>

                </h3>

                
                <?php if($kost->foto->count()): ?>

                <div id="kostCarousel" class="carousel slide mb-3" data-bs-ride="carousel">

                    
                    <div class="carousel-inner rounded overflow-hidden">

                        <?php $__currentLoopData = $kost->foto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">

                            <img src="<?php echo e(asset('storage/' . $foto->foto)); ?>"
                                class="d-block w-100"
                                style="height:500px;object-fit:cover;">

                        </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                    
                    <button class="carousel-control-prev"
                        type="button"
                        data-bs-target="#kostCarousel"
                        data-bs-slide="prev">

                        <span class="carousel-control-prev-icon"></span>

                    </button>

                    <button class="carousel-control-next"
                        type="button"
                        data-bs-target="#kostCarousel"
                        data-bs-slide="next">

                        <span class="carousel-control-next-icon"></span>

                    </button>

                </div>

                
                <div class="d-flex flex-wrap gap-3">

                    <?php $__currentLoopData = $kost->foto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="position-relative">

                        
                        <button type="button"
                            data-bs-target="#kostCarousel"
                            data-bs-slide-to="<?php echo e($key); ?>"
                            class="border-0 bg-transparent p-0">

                            <img src="<?php echo e(asset('storage/' . $foto->foto)); ?>"
                                class="rounded border shadow-sm"
                                style="width:120px;height:90px;object-fit:cover;cursor:pointer;">

                        </button>

                        
                        <form action="<?php echo e(route('kost-foto.destroy', $foto->id)); ?>"
                            method="POST"
                            class="position-absolute top-0 end-0 m-1">

                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button type="submit"
                                class="btn btn-danger btn-sm rounded-circle"
                                style="width:28px;height:28px;padding:0;"
                                onclick="return confirm('Hapus foto ini?')">

                                &times;

                            </button>

                        </form>

                    </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

                <?php else: ?>

                
                <img src="<?php echo e(asset('template/paneladmin/assets/img/background/1.jpg')); ?>"
                    class="img-fluid rounded"
                    style="width:100%;height:500px;object-fit:cover;">

                <?php endif; ?>

            </div>

        </div>

    </div>

    
    <div class="col-md-4">

        
        <div class="card mb-4 border-0 shadow-sm">

            <div class="card-body">

                <h5 class="fw-bold mb-4">
                    Informasi Kost
                </h5>

                
                <div class="mb-4">

                    <small class="text-muted d-block mb-1">
                        Harga
                    </small>

                    <h3 class="fw-bold text-primary mb-0">
                        Rp <?php echo e(number_format($kost->harga, 0, ',', '.')); ?>

                    </h3>

                </div>

                
                <div class="mb-4">

                    <small class="text-muted d-block mb-1">
                        Jenis Kost
                    </small>

                    <span class="badge bg-primary px-3 py-2">
                        <?php echo e(optional($kost->jenis)->jenis_kost); ?>

                    </span>

                </div>

                
                <div class="mb-4">

                    <small class="text-muted d-block mb-1">
                        Daerah
                    </small>

                    <p class="mb-0 fw-semibold">
                        <?php echo e(optional($kost->daerah)->name); ?>

                    </p>

                </div>

                
                <div class="mb-4">

                    <small class="text-muted d-block mb-1">
                        Alamat
                    </small>

                    <p class="mb-0">
                        <?php echo e($kost->alamat); ?>

                    </p>

                </div>

                
                <div>

                    <small class="text-muted d-block mb-2">
                        Fasilitas
                    </small>

                    <?php $__currentLoopData = $kost->fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <span class="badge bg-success mb-2 px-3 py-2">
                        <?php echo e($f->nama_fasilitas); ?>

                    </span>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

            </div>

        </div>

        
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h5 class="fw-bold mb-3">
                    Upload Foto Baru
                </h5>

                <form action="<?php echo e(route('kost-foto.store', $kost->id)); ?>"
                    method="POST"
                    enctype="multipart/form-data">

                    <?php echo csrf_field(); ?>

                    <input type="file"
                        name="foto[]"
                        multiple
                        class="form-control mb-3">

                    <button class="btn btn-primary w-100">
                        Upload Foto
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/admin/pages/manajemenkost/detail-kost.blade.php ENDPATH**/ ?>