@extends('admin.layouts.app')

@section('title', 'Jenis Kost')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Jenis Kost</h5>
        <!-- Button Tambah Jenis Kost -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJenisModal">Tambah Jenis</button>
    </div>

    <div class="card-body">
        <!-- Tabel Jenis Kost -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Jenis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jenis as $key => $j)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $j->jenis_kost }}</td>
                    <td>
                        <!-- Button Edit -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editJenisModal{{ $j->id }}">Edit</button>

                        <!-- Form Hapus -->
                        <form action="{{ route('jenis-kost.destroy', $j->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editJenisModal{{ $j->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('jenis-kost.update', $j->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Jenis Kost</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="jenis_kost" class="form-control" value="{{ $j->jenis_kost }}" required>
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

<!-- Modal Tambah Jenis Kost -->
<div class="modal fade" id="addJenisModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('jenis-kost.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jenis Kost</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="jenis_kost" class="form-control" placeholder="Nama Jenis Kost" required>
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
