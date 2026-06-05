<?php $__env->startSection('title', 'Dashboard | SIPKOS'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12 mb-6">
            <div class="card h-100">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">Selamat Datang, <?php echo e(auth()->user()->name ?? 'Admin'); ?>!
                                🎉</h5>
                            <p class="mb-4">
                                Anda berada di panel kendali <span class="fw-bold">SIPKOS</span> (Sistem Informasi &
                                Rekomendasi Kost). Pantau seluruh metrik, data pengguna, dan pertumbuhan kost di sini.
                            </p>
                            <a href="<?php echo e(route('data-kost.index')); ?>" class="btn btn-sm btn-outline-primary">Kelola Data
                                Kost</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-6">
                            <img src="<?php echo e(asset('template/paneladmin/assets/img/illustrations/man-with-laptop.png')); ?>"
                                height="175" alt="View Badge User" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-group fs-4"></i></span>
                        </div>
                    </div>
                    <p class="mb-1 text-muted">Pencari Kost</p>
                    <h4 class="card-title mb-0"><?php echo e($totalUser); ?> <small class="text-muted fs-6">User</small></h4>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-user-pin fs-4"></i></span>
                        </div>
                    </div>
                    <p class="mb-1 text-muted">Pemilik Kost</p>
                    <h4 class="card-title mb-0"><?php echo e($totalOwner); ?> <small class="text-muted fs-6">Owner</small></h4>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-primary"><i
                                    class="bx bx-buildings fs-4"></i></span>
                        </div>
                    </div>
                    <p class="mb-1 text-muted">Total Kost</p>
                    <h4 class="card-title mb-0"><?php echo e($totalKost); ?> <small class="text-muted fs-6">Unit</small></h4>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-money fs-4"></i></span>
                        </div>
                    </div>
                    <p class="mb-1 text-muted">Rata-rata Harga</p>
                    <h4 class="card-title mb-0 fs-5 text-truncate">Rp <?php echo e(number_format($rataHarga, 0, ',', '.')); ?></h4>
                </div>
            </div>
        </div>

        <div class="col-12 mb-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Grafik Statistik Sistem</h5>
                        <small class="text-muted">Perbandingan jumlah User, Owner, dan Data Kost</small>
                    </div>
                </div>
                <div class="card-body">
                    <div id="grafikSistemChart" style="min-height: 300px;"></div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Data dari Controller Laravel
            const jumlahUser = <?php echo e($totalUser); ?>;
            const jumlahOwner = <?php echo e($totalOwner); ?>;
            const jumlahKost = <?php echo e($totalKost); ?>;

            const chartOptions = {
                series: [{
                    name: 'Jumlah Data',
                    data: [jumlahUser, jumlahOwner, jumlahKost]
                }],
                chart: {
                    type: 'bar', // Ubah ke 'pie' atau 'donut' jika ingin bentuk lingkaran
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '40%',
                        distributed: true // Membuat warna setiap batang berbeda
                    }
                },
                colors: ['#03c3ec', '#71dd37', '#696cff'], // Info, Success, Primary
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '14px',
                        colors: ['#fff']
                    }
                },
                xaxis: {
                    categories: ['Pencari Kost (User)', 'Pemilik Kost (Owner)', 'Total Unit Kost'],
                    labels: {
                        style: {
                            fontSize: '13px',
                            fontWeight: 600
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Total (Angka)'
                    }
                },
                legend: {
                    show: false // Disembunyikan karena label sudah ada di bawah
                },
                tooltip: {
                    theme: 'light'
                }
            };

            const grafikSistem = new ApexCharts(document.querySelector("#grafikSistemChart"), chartOptions);
            grafikSistem.render();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/admin/pages/dashboard.blade.php ENDPATH**/ ?>