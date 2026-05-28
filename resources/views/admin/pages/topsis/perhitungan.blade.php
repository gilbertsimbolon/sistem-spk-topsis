@extends('admin.layouts.app')

@section('title', 'Hasil Rekomendasi TOPSIS | SIPKOS')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Hasil Perangkingan Rekomendasi Kost (TOPSIS)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th width="80">Rank</th>
                            <th>Nama Kost</th>
                            <th>Harga Sewa</th>
                            <th>Jarak Ideal (D+)</th>
                            <th>Jarak Terburuk (D-)</th>
                            <th>Nilai Preferensi (V)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasilAkhir as $index => $hasil)
                            <tr>
                                <td>
                                    @if ($index == 0)
                                        <span class="badge bg-warning text-dark fs-6 shadow-sm">
                                            <i class="bi bi-trophy-fill text-danger me-1"></i> 1
                                        </span>
                                    @elseif($index == 1)
                                        <span class="badge bg-light text-dark border fs-6 shadow-sm">
                                            <i class="bi bi-medal-fill text-secondary me-1"></i> 2
                                        </span>
                                    @elseif($index == 2)
                                        <span class="badge bg-light text-dark border fs-6 shadow-sm">
                                            <i class="bi bi-medal-fill text-warning me-1"></i> 3
                                        </span>
                                    @else
                                        <span class="badge bg-secondary text-white fs-6 ps-3 pe-3">
                                            {{ $index + 1 }}
                                        </span>
                                    @endif
                                </td>
                                <td><span class="fw-bold text-dark">{{ $hasil['nama_kost'] }}</span></td>
                                <td>Rp {{ number_format($hasil['harga'], 0, ',', '.') }}</td>
                                <td>{{ number_format($hasil['d_positif'], 4) }}</td>
                                <td>{{ number_format($hasil['d_negatif'], 4) }}</td>
                                <td>
                                    <span class="fw-bold text-dark fs-5">{{ number_format($hasil['skor_v'], 4) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Matriks Keputusan Awal (X)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle mb-0">
                    <thead>
                        <tr class="text-center">
                            <th>Alternatif / Kost</th>
                            @foreach ($criterias as $c)
                                <th>
                                    {{ $c->nama_kriteria }}
                                    <small class="d-block text-muted text-capitalize">({{ $c->tipe }})</small>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kosts as $k)
                            <tr>
                                <td class="fw-bold text-dark">{{ $k->nama_kost }}</td>
                                @foreach ($criterias as $c)
                                    <td class="text-center">
                                        {{ isset($matriksX[$k->id][$c->id]) ? $matriksX[$k->id][$c->id] : 0 }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
