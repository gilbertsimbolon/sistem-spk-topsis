<?php $__env->startSection('title', 'Data Kost | SIPKOST'); ?>

<?php $__env->startSection('content'); ?>

<!-- Tampilan Data Kost -->
<div class="card mb-4">

    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Kost</h5>

        <!-- hanya admin yang bisa tambah data -->
        <?php if(auth()->user()->role == 'admin' || auth()->user()->role == 'owner'): ?>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCreate">
            + Tambah Kost
        </button>
        <?php endif; ?>
    </div>

    <div class="card-body">

        <div class="row">

            <?php $__currentLoopData = $kost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-4">
                <a href="<?php echo e(route('data-kost.show', $k->id)); ?>" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm">

                        <!-- Foto -->
                        <?php if($k->foto->count()): ?>
                        <img src="<?php echo e(asset('storage/' . $k->foto->first()->foto)); ?>" class="card-img-top"
                            style="height:180px;object-fit:cover;">
                        <?php else: ?>
                        <img src="<?php echo e(asset('template/paneladmin/assets/img/background/1.jpg')); ?>"
                            class="card-img-top" style="height:180px;object-fit:cover;">
                        <?php endif; ?>

                        <div class="card-body">

                            <!-- NAMA -->
                            <h5 class="mb-1"><?php echo e($k->nama_kost); ?></h5>

                            <!-- ALAMAT -->
                            <small class="text-muted"><?php echo e($k->daerah->name ?? '-'); ?></small>

                            <!-- Jenis -->
                            <div class="mt-2">
                                <span class="badge bg-primary">
                                    <?php echo e(optional($k->jenis)->jenis_kost ?? '-'); ?>

                                </span>
                            </div>

                            <!-- HARGA -->
                            <h6 class="mt-2">
                                Rp <?php echo e(number_format($k->harga, 0, ',', '.')); ?>

                            </h6>

                            <!-- FASILITAS -->
                            <div class="mt-2">
                                <?php $__currentLoopData = $k->fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge bg-success mb-1">
                                    <?php echo e($f->nama_fasilitas); ?>

                                </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <!-- Aksi -->
                            <div class="mt-3 d-flex gap-2">

                                <!-- Modal edit -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEdit<?php echo e($k->id); ?>">
                                    Edit
                                </button>

                                <!-- DELETE -->
                                <form action="<?php echo e(route('data-kost.destroy', $k->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">
                                        Hapus
                                    </button>
                                </form>

                            </div>

                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </div>

</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="<?php echo e(route('data-kost.store')); ?>" method="POST" enctype="multipart/form-data">

                <?php echo csrf_field(); ?>

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kost</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="text" name="nama_kost" class="form-control mb-2" placeholder="Nama Kost">

                    <textarea name="alamat" class="form-control mb-2" placeholder="Alamat"></textarea>

                    <input type="number" name="harga" class="form-control mb-2" placeholder="Harga">

                    <!-- Jenis -->
                    <select name="jenis_kost_id" class="form-control mb-2">
                        <?php $__currentLoopData = $jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($j->id); ?>">
                            <?php echo e($j->jenis_kost); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <!-- Daerah -->
                    <select name="daerah_kost_id" class="form-control mb-2">
                        <?php $__currentLoopData = $daerah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($d->id); ?>">
                            <?php echo e($d->name); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <!-- Fasilitas -->
                    <label class="mb-1">Fasilitas</label><br>
                    <?php $__currentLoopData = $fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="me-2">
                        <input type="checkbox" name="fasilitas[]" value="<?php echo e($f->id); ?>">
                        <?php echo e($f->nama_fasilitas); ?>

                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <hr>

                    <!-- Foto -->
                    <input type="file" name="foto[]" multiple class="form-control">

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<?php $__currentLoopData = $kost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="modalEdit<?php echo e($k->id); ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="<?php echo e(route('data-kost.update', $k->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="modal-header">
                    <h5 class="modal-title">Edit Kost</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    
                    <input type="text" name="nama_kost" value="<?php echo e($k->nama_kost); ?>" class="form-control mb-2">

                    
                    <textarea name="alamat" class="form-control mb-2"><?php echo e($k->alamat); ?></textarea>

                    
                    <input type="number" name="harga" value="<?php echo e($k->harga); ?>" class="form-control mb-2">

                    
                    <select name="jenis_kost_id" class="form-control mb-2">
                        <?php $__currentLoopData = $jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($j->id); ?>" <?php if($k->jenis_kost_id == $j->id): ?> selected <?php endif; ?>>
                            <?php echo e($j->jenis_kost); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    
                    <select name="daerah_kost_id" class="form-control mb-2">
                        <?php $__currentLoopData = $daerah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($d->id); ?>" <?php if($k->daerah_kost_id == $d->id): ?> selected <?php endif; ?>>
                            <?php echo e($d->name); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    
                    <label class="mb-1">Fasilitas</label><br>
                    <?php $__currentLoopData = $fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="me-2">
                        <input type="checkbox" name="fasilitas[]" value="<?php echo e($f->id); ?>"
                            <?php if($k->fasilitas->contains($f->id)): ?> checked <?php endif; ?>>
                        <?php echo e($f->nama_fasilitas); ?>

                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <hr>

                    
                    <label class="mb-1">Foto Saat Ini</label>
                    <div class="d-flex flex-wrap mb-2">
                        <?php $__currentLoopData = $k->foto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="position-relative me-2 mb-2" style="width:120px;">
                            <img src="<?php echo e(asset('storage/' . $foto->foto)); ?>" class="img-thumbnail"
                                style="width:120px; height:100px; object-fit:cover;">
                            
                            <form action="<?php echo e(route('kost-foto.destroy', $foto->id)); ?>" method="POST"
                                class="position-absolute top-0 end-0 m-1">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin hapus foto?')">&times;</button>
                            </form>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <hr>

                    
                    <label class="mb-1">Upload Foto Baru</label>
                    <input type="file" id="foto-new-<?php echo e($k->id); ?>" multiple class="form-control">

                    
                    <div class="d-flex flex-wrap mt-2" id="preview-foto-<?php echo e($k->id); ?>"></div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<script>
    const newFotos = {}; // menampung file baru per kostId

    function handleNewFoto(input, kostId) {
        if (!newFotos[kostId]) newFotos[kostId] = [];
        const previewContainer = document.getElementById('preview-foto-' + kostId);

        Array.from(input.files).forEach(file => {
            newFotos[kostId].push(file);
            const index = newFotos[kostId].length - 1;

            const div = document.createElement('div');
            div.style.position = 'relative';
            div.style.marginRight = '0.5rem';
            div.style.marginBottom = '0.5rem';
            div.style.width = '120px';
            div.style.height = '100px';
            div.dataset.index = index;

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.width = '100%';
            img.style.height = '100%';
            img.style.objectFit = 'cover';
            img.classList.add('img-thumbnail');

            // tombol hapus preview
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.innerHTML = '&times;';
            btn.className = 'btn btn-sm btn-danger position-absolute top-0 end-0 m-1';
            btn.onclick = () => {
                newFotos[kostId].splice(index, 1);
                div.remove();
            };

            div.appendChild(img);
            div.appendChild(btn);
            previewContainer.appendChild(div);
        });

        // kosongkan input supaya bisa pilih ulang
        input.value = '';
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/admin/pages/manajemenkost/data-kost.blade.php ENDPATH**/ ?>