@extends('admin.layouts.app')

@section('title', 'Penilaian Alternatif | SIPKOS')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark">Matriks Keputusan (Otomatis)</h5>
        <span class="badge bg-success px-3 py-2">✨ Terisi Otomatis dari Data Kos</span>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%" rowspan="2" class="align-middle">#</th>
                        <th rowspan="2" class="align-middle text-start">Nama Kost</th>
                        <th colspan="{{ $totalKriteria }}" class="text-center">Kriteria (Nilai Bobot TOPSIS 1-5)</th>
                    </tr>
                    <tr>
                        @foreach($criterias as $c)
                            <th>{{ $c->nama_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($kosts as $key => $k)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="text-start"><span class="fw-bold text-dark">{{ $k->nama_kost }}</span></td>
                        
                        @foreach($criterias as $c)
                            @php
                                $dataMatriks = $k->matriks[$c->id] ?? ['bobot' => 1, 'riil' => 0];
                            @endphp
                            <td>
                                <span class="badge bg-primary px-3 py-2 fs-6" 
                                      data-bs-toggle="tooltip" 
                                      data-bs-placement="top"
                                      title="Nilai Riil: {{ $dataMatriks['riil'] }}">
                                    {{ $dataMatriks['bobot'] }}
                                </span>
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endsection