

<?php $__env->startSection('title', 'Data Sub Kriteria | SIPKOS'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
            <h5 class="mb-0 fw-bold text-dark">Data Sub Kriteria TOPSIS</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubKriteriaModal">
                <i class="bi bi-plus-circle me-1"></i> Tambah Sub Kriteria
            </button>
        </div>

        <div class="card-body">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <ul class="nav nav-tabs mb-4" id="kriteriaTab" role="tablist">
                <?php $__currentLoopData = $criterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo e($index === 0 ? 'active fw-bold text-primary' : 'text-secondary'); ?>"
                            id="tab-<?php echo e($c->id); ?>" data-bs-toggle="tab" data-bs-target="#content-<?php echo e($c->id); ?>"
                            type="button" role="tab" aria-controls="content-<?php echo e($c->id); ?>"
                            aria-selected="<?php echo e($index === 0 ? 'true' : 'false'); ?>">
                            <?php echo e($c->nama_kriteria); ?>

                        </button>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <div class="tab-content" id="kriteriaTabContent">
                <?php $__currentLoopData = $criterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tab-pane fade <?php echo e($index === 0 ? 'show active' : ''); ?>" id="content-<?php echo e($c->id); ?>"
                        role="tabpanel" aria-labelledby="tab-<?php echo e($c->id); ?>">

                        <div class="table-responsive">
                            <table class="table table-striped align-middle border">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 25%">Rentang Nilai Riil</th>
                                        <th>Keterangan Sub Kriteria</th>
                                        <th style="width: 15%">Nilai (Skala)</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Filter data sub kriteria yang hanya milik kriteria saat ini
                                        $filteredSubs = $subCriterias->where('criteria_id', $c->id);
                                        $no = 1;
                                    ?>

                                    <?php if($filteredSubs->isEmpty()): ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">Belum ada data sub
                                                kriteria untuk kriteria <?php echo e($c->nama_kriteria); ?>.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $filteredSubs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($no++); ?></td>
                                                <td>
                                                    <?php if($s->nilai_minimum !== null || $s->nilai_maksimum !== null): ?>
                                                        <span class="badge bg-light text-dark border">
                                                            <?php echo e(number_format($s->nilai_minimum, 0, ',', '.')); ?> -
                                                            <?php echo e(number_format($s->nilai_maksimum, 0, ',', '.')); ?>

                                                        </span>
                                                    <?php else: ?>
                                                        <span class="text-muted">—</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><span class="fw-semibold"><?php echo e($s->keterangan); ?></span></td>
                                                <td><span
                                                        class="badge bg-primary px-3 py-2 fs-6"><?php echo e($s->nilai); ?></span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal"
                                                        data-bs-target="#editSubKriteriaModal<?php echo e($s->id); ?>">Edit</button>

                                                    <form action="<?php echo e(route('sub-kriteria.destroy', $s->id)); ?>"
                                                        method="POST" class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin ingin menghapus sub kriteria ini?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="editSubKriteriaModal<?php echo e($s->id); ?>"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="<?php echo e(route('sub-kriteria.update', $s->id)); ?>"
                                                        method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Sub Kriteria:
                                                                    <?php echo e($c->nama_kriteria); ?></h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="criteria_id"
                                                                    value="<?php echo e($s->criteria_id); ?>">

                                                                <?php if(strtolower(trim($c->nama_kriteria)) === 'harga' || strtolower(trim($c->nama_kriteria)) === 'jarak'): ?>
                                                                    <div class="row mb-3">
                                                                        <div class="col-6">
                                                                            <label class="form-label">Nilai Minimum</label>
                                                                            <input type="number" name="nilai_minimum"
                                                                                class="form-control"
                                                                                value="<?php echo e($s->nilai_minimum); ?>" required>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label class="form-label">Nilai Maksimum</label>
                                                                            <input type="number" name="nilai_maksimum"
                                                                                class="form-control"
                                                                                value="<?php echo e($s->nilai_maksimum); ?>" required>
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Keterangan Sub
                                                                        Kriteria</label>
                                                                    <input type="text" name="keterangan"
                                                                        class="form-control" value="<?php echo e($s->keterangan); ?>"
                                                                        required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Nilai / Bobot Sub</label>
                                                                    <input type="number" name="nilai"
                                                                        class="form-control" value="<?php echo e($s->nilai); ?>"
                                                                        min="1" max="5" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan
                                                                    Perubahan</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addSubKriteriaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?php echo e(route('sub-kriteria.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Sub Kriteria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Pilih Kriteria Utama</label>
                            <select name="criteria_id" id="selectKriteriaUtama" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Kriteria --</option>
                                <?php $__currentLoopData = $criterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($c->id); ?>"
                                        data-nama="<?php echo e(strtolower(trim($c->nama_kriteria))); ?>"><?php echo e($c->nama_kriteria); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="row mb-3 d-none" id="inputRentangWrapper">
                            <div class="col-6">
                                <label class="form-label">Nilai Minimum</label>
                                <input type="number" name="nilai_minimum" id="nilaiMinimum" class="form-control"
                                    placeholder="Contoh: 0">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Nilai Maksimum</label>
                                <input type="number" name="nilai_maksimum" id="nilaiMaksimum" class="form-control"
                                    placeholder="Contoh: 500000">
                            </div>
                        </div>

                        <div class="mb-3 d-none" id="dropdownKeteranganWrapper">
                            <label class="form-label">Label Keterangan Sub Kriteria</label>
                            <select name="nama_sub_kriteria_manual" id="namaSubManual" class="form-select">
                            </select>
                        </div>

                        <div class="mb-3 d-none" id="inputFasilitasWrapper">
                            <label class="form-label">Pilih Item Fasilitas Master</label>
                            <select name="nama_sub_kriteria_fasilitas" id="namaSubFasilitas" class="form-select">
                                <option value="" disabled selected>-- Pilih Fasilitas --</option>
                                <?php $__currentLoopData = $fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($f->nama_fasilitas); ?>"><?php echo e($f->nama_fasilitas); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <small class="text-muted d-block mt-1">💡 List ini diambil otomatis dari tabel master fasilitas
                                kamu.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nilai Bobot TOPSIS (Skala 1 - 5)</label>
                            <select name="nilai" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Skala Nilai --</option>
                                <option value="5">5 (Sangat Baik / Sangat Murah / Sangat Dekat)</option>
                                <option value="4">4 (Baik / Murah / Dekat)</option>
                                <option value="3">3 (Cukup)</option>
                                <option value="2">2 (Kurang / Buruk)</option>
                                <option value="1">1 (Sangat Kurang / Sangat Buruk)</option>
                            </select>
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

    <script>
        const opsiKeterangan = {
            harga: ["Sangat Murah", "Murah", "Cukup", "Mahal", "Sangat Mahal"],
            jarak: ["Sangat Dekat", "Dekat", "Cukup Dekat", "Jauh", "Sangat Jauh"],
            keamanan: ["Sangat Aman", "Aman", "Cukup Aman", "Kurang Aman", "Tidak Aman"],
            kebersihan: ["Sangat Bersih", "Bersih", "Cukup Bersih", "Kurang Bersih", "Kotor"]
        };

        document.getElementById('selectKriteriaUtama').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var namaKriteria = selectedOption.getAttribute('data-nama').trim();

            var rentangWrapper = document.getElementById('inputRentangWrapper');
            var keteranganWrapper = document.getElementById('dropdownKeteranganWrapper');
            var fasilitasWrapper = document.getElementById('inputFasilitasWrapper');

            var nilaiMinimum = document.getElementById('nilaiMinimum');
            var nilaiMaksimum = document.getElementById('nilaiMaksimum');
            var selectKeterangan = document.getElementById('namaSubManual');
            var selectFasilitas = document.getElementById('namaSubFasilitas');

            // Reset view modal input
            rentangWrapper.classList.add('d-none');
            keteranganWrapper.classList.add('d-none');
            fasilitasWrapper.classList.add('d-none');

            nilaiMinimum.removeAttribute('required');
            nilaiMaksimum.removeAttribute('required');
            selectKeterangan.removeAttribute('required');
            selectFasilitas.removeAttribute('required');

            nilaiMinimum.value = "";
            nilaiMaksimum.value = "";
            selectKeterangan.innerHTML = '';
            selectFasilitas.selectedIndex = 0;

            if (opsiKeterangan[namaKriteria]) {
                keteranganWrapper.classList.remove('d-none');
                selectKeterangan.setAttribute('required', 'required');
                selectKeterangan.innerHTML =
                    `<option value="" disabled selected>-- Pilih Keterangan ${selectedOption.text} --</option>`;

                opsiKeterangan[namaKriteria].forEach(function(item) {
                    var option = document.createElement('option');
                    option.value = item;
                    option.text = item;
                    selectKeterangan.appendChild(option);
                });

                if (namaKriteria === 'harga' || namaKriteria === 'jarak') {
                    rentangWrapper.classList.remove('d-none');
                    nilaiMinimum.setAttribute('required', 'required');
                    nilaiMaksimum.setAttribute('required', 'required');
                }
            } else if (namaKriteria === 'fasilitas') {
                fasilitasWrapper.classList.remove('d-none');
                selectFasilitas.setAttribute('required', 'required');
            }
        });

        // Menjaga agar tulisan tab aktif berwarna tegas
        var tabEl = document.querySelectorAll('button[data-bs-toggle="tab"]')
        tabEl.forEach(function(el) {
            el.addEventListener('shown.bs.tab', function(event) {
                tabEl.forEach(tab => tab.classList.remove('fw-bold', 'text-primary'));
                event.target.classList.add('fw-bold', 'text-primary');
            })
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/admin/pages/topsis/data-sub-kriteria.blade.php ENDPATH**/ ?>