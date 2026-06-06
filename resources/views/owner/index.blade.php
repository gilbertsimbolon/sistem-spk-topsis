@extends('admin.layouts.app')

@section('title', 'Kelola Kost Saya | SIPKOST')

@section('content')

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Kost Saya</h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCreate">
            + Tambah Kost
        </button>
    </div>

    <div class="card-body">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @forelse ($kosts as $k)
            <div class="col-md-4 mb-4">
                {{-- PERBAIKAN: Mengubah route ke 'owner.kost.show' --}}
                <a href="{{ route('owner.kost.show', $k->id) }}" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm">

                        @if ($k->foto->count())
                        <img src="{{ asset('storage/' . $k->foto->first()->foto) }}" class="card-img-top" style="height:180px;object-fit:cover;">
                        @else
                        <img src="{{ asset('template/paneladmin/assets/img/background/1.jpg') }}" class="card-img-top" style="height:180px;object-fit:cover;">
                        @endif

                        <div class="card-body">
                            <h5 class="mb-1">{{ $k->nama_kost }}</h5>
                            <small class="text-muted">{{ $k->daerah->name ?? '-' }}</small>

                            <div class="mt-2">
                                <span class="badge bg-primary">
                                    {{ optional($k->jenis)->jenis_kost ?? '-' }}
                                </span>
                            </div>

                            <h6 class="mt-2">
                                Rp {{ number_format($k->harga, 0, ',', '.') }}
                            </h6>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Anda belum memiliki data kost terdaftar.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

{{-- MODAL CREATE --}}
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- PERBAIKAN: Mengubah form action ke 'owner.kost.store' --}}
            <form action="{{ route('owner.kost.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kost</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="text" name="nama_kost" class="form-control mb-2" placeholder="Nama Kost" required>
                    <textarea name="alamat" class="form-control mb-2" placeholder="Alamat" required></textarea>
                    <input type="number" name="harga" class="form-control mb-2" placeholder="Harga" required>

                    <select name="jenis_kost_id" class="form-control mb-2" required>
                        <option value="">-- Pilih Jenis --</option>
                        @foreach ($jenis as $j)
                        <option value="{{ $j->id }}">{{ $j->jenis_kost }}</option>
                        @endforeach
                    </select>

                    <select name="daerah_kost_id" class="form-control mb-2" required>
                        <option value="">-- Pilih Daerah --</option>
                        @foreach ($daerah as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>

                    <label class="mb-1 fw-bold mt-2">Fasilitas</label><br>
                    @foreach ($fasilitas as $f)
                    <label class="me-2">
                        <input type="checkbox" name="fasilitas[]" value="{{ $f->id }}"> {{ $f->keterangan }}
                    </label>
                    @endforeach
                    <hr>

                    <label class="mb-1 fw-bold">Keamanan</label><br>
                    @foreach ($keamanan as $k)
                    <label class="me-2">
                        <input type="checkbox" name="keamanan[]" value="{{ $k->id }}"> {{ $k->keterangan }}
                    </label>
                    @endforeach
                    <hr>

                    <label class="mb-1 fw-bold">Kebersihan</label><br>
                    @foreach ($kebersihan as $kb)
                    <label class="me-2">
                        <input type="checkbox" name="kebersihan[]" value="{{ $kb->id }}"> {{ $kb->keterangan }}
                    </label>
                    @endforeach
                    <hr>

                    <label class="mb-1 fw-bold">Upload Foto</label>
                    <input type="file" name="foto[]" multiple class="form-control" accept="image/*">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection