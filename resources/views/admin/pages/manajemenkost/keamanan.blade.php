@extends('admin.layouts.app')

@section('title', 'Keamanan Kost')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Keamanan Kost</h5>
        <!-- Button Tambah Keamanan -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKeamananModal">Tambah Keamanan</button>
    </div>

    <div class="card-body">
        <!-- Tabel Keamanan -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Keamanan</th>
                    <th>Bobot</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($keamanan as $key => $f)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $f->keterangan }}</td>
                    <td>{{ $f->bobot }}</td>
                    <td>
                        <!-- Button Edit -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editKeamananModal{{ $f->id }}">Edit</button>

                        <!-- Form Hapus -->
                        <form action="{{ route('keamanan.destroy', $f->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editKeamananModal{{ $f->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('keamanan.update', $f->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Keamanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="keterangan" class="form-control" value="{{ $f->keterangan }}" required>
                                </div>
                                <div class="modal-body">
                                    <input type="integer" name="bobot" class="form-control" value="{{ $f->bobot }}" required>
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

<!-- Modal Tambah Keamanan -->
<div class="modal fade" id="addKeamananModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('keamanan.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Keamanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="keterangan" class="form-control" placeholder="Nama Keamanan" required>
                </div>
                <div class="modal-body">
                    <input type="integer" name="bobot" class="form-control" placeholder="Nilai Bobot (1-5)" required>
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
