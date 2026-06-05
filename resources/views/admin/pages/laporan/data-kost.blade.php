@extends('admin.layouts.app')

@section('title', 'Laporan Data Kost | SIPKOS')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Laporan Seluruh Data Kost</h5>
            <button class="btn btn-primary btn-sm" onclick="window.print()">
                <i class="bi bi-printer me-1"></i> Cetak Laporan
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kost</th>
                            <th>Pemilik</th>
                            <th>Daerah</th>
                            <th>Jenis</th>
                            <th>Harga Sewa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kosts as $index => $kost)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $kost->nama_kost }}</td>
                                <td>{{ optional($kost->user)->name ?? 'Tidak Ada Akun' }}</td>
                                <td>{{ optional($kost->daerah)->name }}</td>
                                <td><span class="badge bg-label-info">{{ optional($kost->jenis)->jenis_kost }}</span></td>
                                <td class="text-success fw-semibold">Rp {{ number_format($kost->harga, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada data kost yang terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
