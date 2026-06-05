@extends('admin.layouts.app')

@section('title', 'Detail Kost | SIPKOST')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="mb-3">
    <a href="{{ route('kost.index') }}" class="btn btn-secondary btn-sm"><i class="bx bx-arrow-back"></i> Kembali</a>
</div>

<div class="row">
    {{-- FOTO & SLIDER --}}
    <div class="col-md-8">
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fw-bold mb-0">
                        {{ $kost->nama_kost }}
                    </h3>
                    
                    {{-- TOMBOL ACTION: EDIT & HAPUS KOST --}}
                    <div class="d-flex gap-2">
                        <button class="btn btn-warning btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#modalEditKost">
                            <i class="bx bx-edit-alt"></i> Edit Kost
                        </button>

                        <form action="{{ route('kost.destroy', $kost->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus seluruh data kost ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm fw-semibold">
                                <i class="bx bx-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>

                {{-- SLIDER FOTO --}}
                @if ($kost->foto->count())
                <div id="kostCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner rounded overflow-hidden">
                        @foreach ($kost->foto as $key => $foto)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $foto->foto) }}" class="d-block w-100" style="height:500px;object-fit:cover;">
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#kostCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#kostCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                {{-- THUMBNAIL BAWAH --}}
                <div class="d-flex flex-wrap gap-3">
                    @foreach ($kost->foto as $key => $foto)
                    <div class="position-relative d-inline-block">
                        <button type="button" data-bs-target="#kostCarousel" data-bs-slide-to="{{ $key }}" class="border-0 bg-transparent p-0">
                            <img src="{{ asset('storage/' . $foto->foto) }}" class="rounded border shadow-sm" style="width:120px;height:90px;object-fit:cover;cursor:pointer;">
                        </button>

                        {{-- DELETE FOTO --}}
                        <form action="{{ route('kost-foto.destroy', $foto->id) }}" method="POST" class="position-absolute top-0 end-0 m-1" onsubmit="event.stopPropagation(); return confirm('Hapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width:24px;height:24px;padding:0;">
                                &times;
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
                @else
                <img src="{{ asset('template/paneladmin/assets/img/background/1.jpg') }}" class="img-fluid rounded" style="width:100%;height:500px;object-fit:cover;">
                @endif
            </div>
        </div>
    </div>

    {{-- DETAIL INFORMASI --}}
    <div class="col-md-4">
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Informasi Kost</h5>

                <div class="mb-4">
                    <small class="text-muted d-block mb-1">Harga</small>
                    <h3 class="fw-bold text-primary mb-0">
                        Rp {{ number_format($kost->harga, 0, ',', '.') }}
                    </h3>
                </div>

                <div class="mb-4">
                    <small class="text-muted d-block mb-1">Jenis Kost</small>
                    <span class="badge bg-primary px-3 py-2">
                        {{ optional($kost->jenis)->jenis_kost }}
                    </span>
                </div>

                <div class="mb-4">
                    <small class="text-muted d-block mb-1">Daerah</small>
                    <p class="mb-0 fw-semibold">{{ optional($kost->daerah)->name }}</p>
                </div>

                <div class="mb-4">
                    <small class="text-muted d-block mb-1">Alamat</small>
                    <p class="mb-0">{{ $kost->alamat }}</p>
                </div>

                <div class="mb-3">
                    <small class="text-muted d-block mb-2">Fasilitas</small>
                    @forelse ($kost->fasilitas as $f)
                    <span class="badge bg-success mb-1 me-1 px-3 py-2">{{ $f->keterangan }}</span>
                    @empty
                    <span class="text-muted text-xs d-block">Tidak ada fasilitas</span>
                    @endforelse
                </div>

                <div class="mb-3">
                    <small class="text-muted d-block mb-2">Keamanan</small>
                    @forelse ($kost->keamanan as $km)
                    <span class="badge bg-success mb-1 me-1 px-3 py-2">{{ $km->keterangan }}</span>
                    @empty
                    <span class="text-muted text-xs d-block">Tidak ada sistem keamanan</span>
                    @endforelse
                </div>

                <div class="mb-3">
                    <small class="text-muted d-block mb-2">Kebersihan</small>
                    @forelse ($kost->kebersihan as $kb)
                    <span class="badge bg-success mb-1 me-1 px-3 py-2">{{ $kb->keterangan }}</span>
                    @empty
                    <span class="text-muted text-xs d-block">Tidak ada info kebersihan</span>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- UPLOAD FOTO BARU --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Upload Foto Baru</h5>
                <form action="{{ route('kost-foto.store', $kost->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="foto[]" multiple required class="form-control mb-3">
                    <button type="submit" class="btn btn-primary w-100">Upload Foto</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT KOST --}}
<div class="modal fade" id="modalEditKost" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('kost.update', $kost->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Data Kost</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Kost</label>
                        <input type="text" name="nama_kost" value="{{ $kost->nama_kost }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required>{{ $kost->alamat }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga (Rp)</label>
                        <input type="number" name="harga" value="{{ $kost->harga }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Kost</label>
                        <select name="jenis_kost_id" class="form-select" required>
                            @foreach ($jenis as $j)
                            <option value="{{ $j->id }}" {{ $kost->jenis_kost_id == $j->id ? 'selected' : '' }}>
                                {{ $j->jenis_kost }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Daerah Kost</label>
                        <select name="daerah_kost_id" class="form-select" required>
                            @foreach ($daerah as $d)
                            <option value="{{ $d->id }}" {{ $kost->daerah_kost_id == $d->id ? 'selected' : '' }}>
                                {{ $d->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label fw-semibold d-block">Fasilitas</label>
                        @foreach ($fasilitas as $f)
                        <div class="form-check form-check-inline me-3">
                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="{{ $f->id }}" id="f-{{ $f->id }}" {{ $kost->fasilitas->contains($f->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="f-{{ $f->id }}">{{ $f->keterangan }}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold d-block">Keamanan</label>
                        @foreach ($keamanan as $dk)
                        <div class="form-check form-check-inline me-3">
                            <input class="form-check-input" type="checkbox" name="keamanan[]" value="{{ $dk->id }}" id="k-{{ $dk->id }}" {{ $kost->keamanan->contains($dk->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="k-{{ $dk->id }}">{{ $dk->keterangan }}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold d-block">Kebersihan</label>
                        @foreach ($kebersihan as $kb)
                        <div class="form-check form-check-inline me-3">
                            <input class="form-check-input" type="checkbox" name="kebersihan[]" value="{{ $kb->id }}" id="kb-{{ $kb->id }}" {{ $kost->kebersihan->contains($kb->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="kb-{{ $kb->id }}">{{ $kb->keterangan }}</label>
                        </div>
                        @endforeach
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection