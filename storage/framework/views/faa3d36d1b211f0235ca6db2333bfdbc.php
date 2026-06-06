<?php $__env->startSection('title', 'Dashboard | Sistem Pemilihan Kost'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .kost-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .kost-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .kost-img {
            height: 180px;
            object-fit: cover;
        }

        .criteria-box {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            border: 1px solid #e9ecef;
            height: 100%;
        }
    </style>

    <div class="py-4">

        <div class="container mb-5">
            <div class="mb-4">
                <h4 class="fw-bold text-dark mb-1"><i class="bi bi-award text-warning me-2"></i>8 Kost Terbaik Berdasarkan Hasil TOPSIS</h4>
            </div>

            <div class="row g-4">
                <?php $__currentLoopData = $kostsTopsis ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="<?php echo e(route('dashboard.kost.show', $kos->id)); ?>" class="text-decoration-none text-dark d-block h-100">
                            <div class="card border-0 shadow-sm h-100 kost-card">
                                <div class="position-relative">
                                    <img src="<?php echo e($kos->foto->isNotEmpty() ? asset('storage/' . $kos->foto->first()->foto) : asset('template/paneladmin/assets/img/background/1.jpg')); ?>" class="card-img-top kost-img" alt="<?php echo e($kos->nama_kost); ?>">
                                    <span class="badge bg-warning position-absolute top-0 start-0 m-2 px-2.5 py-1.5 shadow-sm text-dark fw-bold">
                                        Rekomendasi
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="container mb-5 mt-4">
            <div class="card border-0 shadow-sm border-start border-success border-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 text-dark">
                        <i class="bi bi-search me-2 text-success"></i>Filter Pencarian Kost
                    </h5>

                    <form id="filterForm" action="<?php echo e(route('dashboard.index')); ?>" method="GET">
                        <div class="row g-3 align-items-end">

                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary">Daerah / Wilayah</label>
                                <select class="form-select filter-input" name="daerah_kost_id" id="daerahSelect">
                                    <option value="">Semua Daerah</option>
                                    <?php $__currentLoopData = $daerah ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($d->id); ?>" <?php echo e(request('daerah_kost_id') == $d->id ? 'selected' : ''); ?>>
                                            <?php echo e($d->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary">Jenis Kost</label>
                                <select class="form-select filter-input" name="tipe_kost">
                                    <option value="">Semua jenis</option>
                                    <?php $__currentLoopData = $jenis ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($j->id); ?>" <?php echo e(request('tipe_kost') == $j->id ? 'selected' : ''); ?>>
                                            <?php echo e($j->jenis_kost); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary">Harga Minimal</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-wallet2 text-muted"></i></span>
                                    <input type="text" id="harga_minimal" name="harga_minimal" class="form-control rupiah-field filter-input" value="<?php echo e(request('harga_minimal') ? 'Rp ' . number_format(request('harga_minimal'), 0, ',', '.') : ''); ?>" placeholder="Contoh: Rp 300.000">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary">Harga Maksimal</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-wallet2 text-muted"></i></span>
                                    <input type="text" id="harga_maksimal" name="harga_maksimal" class="form-control rupiah-field filter-input" value="<?php echo e(request('harga_maksimal') ? 'Rp ' . number_format(request('harga_maksimal'), 0, ',', '.') : ''); ?>" placeholder="Contoh: Rp 1.000.000">
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <button class="btn btn-sm btn-outline-success fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKriteria" aria-expanded="false" aria-controls="collapseKriteria">
                                    <i class="bi bi-sliders me-1"></i> Pengaturan Kriteria Tambahan
                                </button>
                            </div>

                            <div class="collapse col-12 <?php echo e(request('fasilitas') || request('keamanan') || request('kebersihan') ? 'show' : ''); ?>" id="collapseKriteria">
                                <div class="row g-3 pt-2">

                                    <div class="col-md-4">
                                        <div class="criteria-box shadow-sm">
                                            <label class="form-label small fw-bold text-success mb-2 d-block"><i class="bi bi-house-heart me-1"></i>Fasilitas Kamar</label>
                                            <div style="max-height: 150px; overflow-y: auto; padding-right: 5px;">
                                                <?php $__currentLoopData = $fasilitas ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check mb-1">
                                                        
                                                        <input class="form-check-input filter-input cb-fasilitas" type="checkbox" value="<?php echo e($f->id); ?>" id="f-<?php echo e($f->id); ?>" <?php echo e(is_array(request('fasilitas')) && in_array($f->id, request('fasilitas')) ? 'checked' : ''); ?>>
                                                        <label class="form-check-label small text-dark" for="f-<?php echo e($f->id); ?>"><?php echo e($f->keterangan); ?></label>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="criteria-box shadow-sm">
                                            <label class="form-label small fw-bold text-primary mb-2 d-block"><i class="bi bi-shield-check me-1"></i>Sistem Keamanan</label>
                                            <div style="max-height: 150px; overflow-y: auto; padding-right: 5px;">
                                                <?php $__currentLoopData = $keamanan ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check mb-1">
                                                        
                                                        <input class="form-check-input filter-input cb-keamanan" type="checkbox" value="<?php echo e($k->id); ?>" id="k-<?php echo e($k->id); ?>" <?php echo e(is_array(request('keamanan')) && in_array($k->id, request('keamanan')) ? 'checked' : ''); ?>>
                                                        <label class="form-check-label small text-dark" for="k-<?php echo e($k->id); ?>"><?php echo e($k->keterangan); ?></label>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="criteria-box shadow-sm">
                                            <label class="form-label small fw-bold text-warning mb-2 d-block"><i class="bi bi-sparkles me-1"></i>Kebersihan</label>
                                            <div style="max-height: 150px; overflow-y: auto; padding-right: 5px;">
                                                <?php $__currentLoopData = $kebersihan ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check mb-1">
                                                        
                                                        <input class="form-check-input filter-input cb-kebersihan" type="checkbox" value="<?php echo e($b->id); ?>" id="b-<?php echo e($b->id); ?>" <?php echo e(is_array(request('kebersihan')) && in_array($b->id, request('kebersihan')) ? 'checked' : ''); ?>>
                                                        <label class="form-check-label small text-dark" for="b-<?php echo e($b->id); ?>"><?php echo e($b->keterangan); ?></label>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 text-end mt-4 d-flex justify-content-end gap-2">
                                <a href="<?php echo e(route('dashboard.index')); ?>" class="btn btn-outline-secondary px-4">Reset</a>
                                <button type="submit" class="btn btn-success px-4 fw-bold shadow-sm">
                                    <i class="bi bi-search me-2"></i>Cari Kost
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container mb-5" id="dashboard-kost-section">
            <div class="mb-4">
                <h5 class="fw-bold text-dark mb-1">Seluruh Kamar Kost</h5>
            </div>

            <div id="ajax-dashboard-kost">
                <div class="row g-4">
                    <?php $__empty_1 = true; $__currentLoopData = $kosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <a href="<?php echo e(route('dashboard.kost.show', $kos->id)); ?>" class="text-decoration-none text-dark d-block h-100">
                                <div class="card border-0 shadow-sm h-100 kost-card">
                                    <div class="position-relative">
                                        <img src="<?php echo e($kos->foto->isNotEmpty() ? asset('storage/' . $kos->foto->first()->foto) : asset('template/paneladmin/assets/img/background/1.jpg')); ?>" class="card-img-top kost-img" alt="<?php echo e($kos->nama_kost); ?>">
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
                    <?php echo e($kosts->appends(request()->query())->links()); ?>

                </div>
            </div>
        </div>

    </div>

    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById('ajax-dashboard-kost');
            const filterForm = document.getElementById('filterForm');

            // 1. Event Delegation pada Pagination
            document.addEventListener('click', function(e) {
                const targetLink = e.target.closest('#ajax-dashboard-kost .pagination a');
                if (targetLink) {
                    e.preventDefault();
                    fetchData(targetLink.getAttribute('href'));
                }
            });

            // 2. Handler Submit Form Filter dengan Konstruksi URL Murni Tanpa Simbol Array Menakutkan
            filterForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const baseUrl = this.getAttribute('action');
                const params = new URLSearchParams();
                
                // Ambil data dropdown dan text inputs
                const dropdownsAndTexts = filterForm.querySelectorAll('select, input[type="text"]');
                dropdownsAndTexts.forEach(input => {
                    let val = input.value;
                    if (val !== "") {
                        if (input.classList.contains('rupiah-field')) {
                            val = val.replace(/\D/g, '');
                        }
                        if (val !== "") {
                            params.append(input.name, val);
                        }
                    }
                });

                // Ambil data Checkbox Kriteria & Susun manual dengan cara murni aman bagi Laravel Auth
                const fasilityCbs = filterForm.querySelectorAll('.cb-fasilitas:checked');
                fasilityCbs.forEach(cb => { params.append('fasilitas[]', cb.value); });

                const securityCbs = filterForm.querySelectorAll('.cb-keamanan:checked');
                securityCbs.forEach(cb => { params.append('keamanan[]', cb.value); });

                const cleanCbs = filterForm.querySelectorAll('.cb-kebersihan:checked');
                cleanCbs.forEach(cb => { params.append('kebersihan[]', cb.value); });

                fetchData(`${baseUrl}?${params.toString()}`);
            });

            // 3. Fungsi Utama AJAX Fetch Data (Bypass & Proteksi Session Maksimal)
            function fetchData(url) {
                if (!url) return;
                container.style.opacity = '0.5';

                fetch(url, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        }
                    })
                    .then(response => {
                        // Jika respon dialihkan paksa ke halaman login (Session Timeout/Intersepsi)
                        if (response.redirected && response.url.includes('login')) {
                            // Fallback Kritis: Jika AJAX gagal karena interseptor, paksa buka URL secara reguler
                            window.location.href = url;
                            return;
                        }
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.text();
                    })
                    .then(html => {
                        if (!html) return;
                        container.innerHTML = html;
                        container.style.opacity = '1';

                        document.getElementById('dashboard-kost-section').scrollIntoView({
                            behavior: 'smooth'
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching filtered data:', error);
                        container.style.opacity = '1';
                    });
            }
        });
    </script>

    
    <script>
        document.querySelectorAll('.rupiah-field').forEach(function(input) {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                let formatted = new Intl.NumberFormat('id-ID').format(value);
                e.target.value = value ? 'Rp ' + formatted : '';
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/user/pages/dashboard.blade.php ENDPATH**/ ?>