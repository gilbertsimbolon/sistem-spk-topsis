@extends('admin.layouts.app')

@section('title', 'Data Sub Kriteria | SIPKOS')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Data Sub Kriteria TOPSIS</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubKriteriaModal">Tambah Sub Kriteria</button>
    </div>

    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kriteria</th>
                    <th>Nama Sub Kriteria</th>
                    <th>Nilai (Skala)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subCriterias as $key => $s)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    {{-- Mengambil nama kriteria dari relasi model --}}
                    <td><span class="fw-bold text-secondary">{{ $s->criteria->nama_kriteria }}</span></td>
                    <td>{{ $s->nama_sub_kriteria }}</td>
                    <td><span class="badge bg-primary">{{ $s->nilai }}</span></td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editSubKriteriaModal{{ $s->id }}">Edit</button>

                        <form action="{{ route('sub-kriteria.destroy', $s->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus sub kriteria ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editSubKriteriaModal{{ $s->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('sub-kriteria.update', $s->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Sub Kriteria</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Pilih Kriteria</label>
                                        <select name="criteria_id" class="form-select" required>
                                            @foreach($criterias as $c)
                                                <option value="{{ $c->id }}" {{ $s->criteria_id == $c->id ? 'selected' : '' }}>
                                                    {{ $c->nama_kriteria }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Sub Kriteria</label>
                                        <input type="text" name="nama_sub_kriteria" class="form-control" value="{{ $s->nama_sub_kriteria }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nilai / Bobot Sub</label>
                                        <input type="number" step="any" name="nilai" class="form-control" value="{{ $s->nilai }}" placeholder="Contoh: 1 sampai 5" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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

<div class="modal fade" id="addSubKriteriaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('sub-kriteria.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sub Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Kriteria Utama</label>
                        <select name="criteria_id" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Kriteria --</option>
                            @foreach($criterias as $c)
                                <option value="{{ $c->id }}">{{ $c->nama_kriteria }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Sub Kriteria</label>
                        <input type="text" name="nama_sub_kriteria" class="form-control" placeholder="Contoh: < 1 Km, Sangat Murah, dll" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nilai (Skala Crisp)</label>
                        <input type="number" step="any" name="nilai" class="form-control" placeholder="Contoh: 5 (Sangat Baik), 1 (Buruk)" required>
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
@endsection