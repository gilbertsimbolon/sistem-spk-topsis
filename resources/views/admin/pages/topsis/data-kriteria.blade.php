@extends('admin.layouts.app')

@section('title', 'Data Kriteria | SIPKOS')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Data Kriteria TOPSIS</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKriteriaModal">Tambah Kriteria</button>
    </div>

    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kriteria</th>
                    <th>Tipe</th>
                    <th class="text-center">Bobot</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($criteria as $key => $c)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $c->nama_kriteria }}</td>
                    <td>
                        @if($c->tipe == 'benefit')
                            <span class="badge bg-success text-capitalize">{{ $c->tipe }}</span>
                        @else
                            <span class="badge bg-danger text-capitalize">{{ $c->tipe }}</span>
                        @endif
                    </td>
                    <td class="text-center">{{ $c->bobot }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editKriteriaModal{{ $c->id }}">Edit</button>

                        <form action="{{ route('data-kriteria.destroy', $c->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus kriteria ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editKriteriaModal{{ $c->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('data-kriteria.update', $c->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Kriteria</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Kriteria</label>
                                        <input type="text" name="nama_kriteria" class="form-control" value="{{ $c->nama_kriteria }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tipe Kriteria</label>
                                        <select name="tipe" class="form-select" required>
                                            <option value="benefit" {{ $c->tipe == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                            <option value="cost" {{ $c->tipe == 'cost' ? 'selected' : '' }}>Cost</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Bobot Kriteria</label>
                                        <input type="number" step="any" name="bobot" class="form-control" value="{{ $c->bobot }}" required>
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

<div class="modal fade" id="addKriteriaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('data-kriteria.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kriteria</label>
                        <input type="text" name="nama_kriteria" class="form-control" placeholder="Contoh: Harga, Jarak, Fasilitas" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipe Kriteria</label>
                        <select name="tipe" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Tipe --</option>
                            <option value="benefit">Benefit</option>
                            <option value="cost">Cost</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bobot Kriteria</label>
                        <input type="number" step="any" name="bobot" class="form-control" placeholder="Contoh: 0.3 atau 30" required>
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