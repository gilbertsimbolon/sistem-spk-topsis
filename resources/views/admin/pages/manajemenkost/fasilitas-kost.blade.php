@extends('admin.layouts.app')

@section('title', 'Fasilitas Kost')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Fasilitas Kost</h5>
        <!-- Button Tambah Fasilitas -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFasilitasModal">Tambah Fasilitas</button>
    </div>

    <div class="card-body">
        <!-- Tabel Fasilitas -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Fasilitas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fasilitas as $key => $f)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $f->nama_fasilitas }}</td>
                    <td>
                        <!-- Button Edit -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editFasilitasModal{{ $f->id }}">Edit</button>

                        <!-- Form Hapus -->
                        <form action="{{ route('fasilitas.destroy', $f->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editFasilitasModal{{ $f->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('fasilitas.update', $f->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Fasilitas</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="nama_fasilitas" class="form-control" value="{{ $f->nama_fasilitas }}" required>
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

<!-- Modal Tambah Fasilitas -->
<div class="modal fade" id="addFasilitasModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('fasilitas.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Fasilitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="nama_fasilitas" class="form-control" placeholder="Nama Fasilitas" required>
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
