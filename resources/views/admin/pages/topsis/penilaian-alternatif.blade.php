@extends('admin.layouts.app')

@section('title', 'Penilaian Alternatif | SIPKOS')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Penilaian Alternatif (Data Kost)</h5>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kost</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kosts as $key => $k)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><span class="fw-bold">{{ $k->nama_kost }}</span></td>
                    <td>
                        @php $count = $k->penilaianAlternatifs->count(); @endphp
                        @if($count >= $totalKriteria)
                            <span class="badge bg-success">Lengkap</span>
                        @else
                            <span class="badge bg-warning">Belum Lengkap ({{ $count }}/{{ $totalKriteria }})</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#penilaianModal{{ $k->id }}">
                            Input Nilai
                        </button>
                    </td>
                </tr>

                <div class="modal fade" id="penilaianModal{{ $k->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form action="{{ route('penilaian-alternatif.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kost_id" value="{{ $k->id }}">
                            
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Penilaian: {{ $k->nama_kost }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        @foreach($criterias as $c)
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">{{ $c->nama_kriteria }}</label>
                                                
                                                {{-- Cari nilai yang sudah tersimpan untuk kriteria ini di kost ini --}}
                                                @php 
                                                    $currentVal = $k->penilaianAlternatifs->where('criteria_id', $c->id)->first()?->nilai; 
                                                @endphp

                                                @if($c->subCriterias->count() > 0)
                                                    <select name="nilai[{{ $c->id }}]" class="form-select" required>
                                                        <option value="" disabled selected>-- Pilih --</option>
                                                        @foreach($c->subCriterias as $sub)
                                                            <option value="{{ $sub->nilai }}" {{ $currentVal == $sub->nilai ? 'selected' : '' }}>
                                                                {{ $sub->nama_sub_kriteria }} ({{ $sub->nilai }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <input type="number" step="any" name="nilai[{{ $c->id }}]" class="form-control" value="{{ $currentVal }}" required>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection