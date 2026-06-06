@extends('admin.layouts.app')

@section('title', 'Dashboard | SIPKOS')

@section('content')
    <div class="row">

        <div class="col-lg-3 col-md-6 col-sm-6 mb-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-group fs-4"></i></span>
                        </div>
                    </div>
                    <p class="mb-1 text-muted">Pencari Kost</p>
                    <h4 class="card-title mb-0">{{ $totalUser }} <small class="text-muted fs-6">User</small></h4>
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
                    <h4 class="card-title mb-0">{{ $totalOwner }} <small class="text-muted fs-6">Owner</small></h4>
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
                    <h4 class="card-title mb-0">{{ $totalKost }} <small class="text-muted fs-6">Unit</small></h4>
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
                    <h4 class="card-title mb-0 fs-5 text-truncate">Rp {{ number_format($rataHarga, 0, ',', '.') }}</h4>
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
            const jumlahUser = {{ $totalUser }};
            const jumlahOwner = {{ $totalOwner }};
            const jumlahKost = {{ $totalKost }};

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
@endsection
