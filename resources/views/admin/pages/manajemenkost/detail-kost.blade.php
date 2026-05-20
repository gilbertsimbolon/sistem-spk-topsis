@extends('admin.layouts.app')

@section('title', 'Detail Kost | SIPKOST')

@section('content')

<div class="row">

    {{-- FOTO --}}
    <div class="col-md-8">

        <div class="card mb-4 border-0 shadow-sm">

            <div class="card-body">

                <h3 class="fw-bold mb-3">
                    {{ $kost->nama_kost }}
                </h3>

                {{-- SLIDER FOTO --}}
                @if ($kost->foto->count())

                <div id="kostCarousel" class="carousel slide mb-3" data-bs-ride="carousel">

                    {{-- FOTO BESAR --}}
                    <div class="carousel-inner rounded overflow-hidden">

                        @foreach ($kost->foto as $key => $foto)

                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                            <img src="{{ asset('storage/' . $foto->foto) }}"
                                class="d-block w-100"
                                style="height:500px;object-fit:cover;">

                        </div>

                        @endforeach

                    </div>

                    {{-- BUTTON PREV NEXT --}}
                    <button class="carousel-control-prev"
                        type="button"
                        data-bs-target="#kostCarousel"
                        data-bs-slide="prev">

                        <span class="carousel-control-prev-icon"></span>

                    </button>

                    <button class="carousel-control-next"
                        type="button"
                        data-bs-target="#kostCarousel"
                        data-bs-slide="next">

                        <span class="carousel-control-next-icon"></span>

                    </button>

                </div>

                {{-- THUMBNAIL BAWAH --}}
                <div class="d-flex flex-wrap gap-3">

                    @foreach ($kost->foto as $key => $foto)

                    <div class="position-relative">

                        {{-- THUMBNAIL --}}
                        <button type="button"
                            data-bs-target="#kostCarousel"
                            data-bs-slide-to="{{ $key }}"
                            class="border-0 bg-transparent p-0">

                            <img src="{{ asset('storage/' . $foto->foto) }}"
                                class="rounded border shadow-sm"
                                style="width:120px;height:90px;object-fit:cover;cursor:pointer;">

                        </button>

                        {{-- DELETE FOTO --}}
                        <form action="{{ route('kost-foto.destroy', $foto->id) }}"
                            method="POST"
                            class="position-absolute top-0 end-0 m-1">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="btn btn-danger btn-sm rounded-circle"
                                style="width:28px;height:28px;padding:0;"
                                onclick="return confirm('Hapus foto ini?')">

                                &times;

                            </button>

                        </form>

                    </div>

                    @endforeach

                </div>

                @else

                {{-- FOTO DEFAULT --}}
                <img src="{{ asset('template/paneladmin/assets/img/background/1.jpg') }}"
                    class="img-fluid rounded"
                    style="width:100%;height:500px;object-fit:cover;">

                @endif

            </div>

        </div>

    </div>

    {{-- DETAIL --}}
    <div class="col-md-4">

        {{-- INFORMASI KOST --}}
        <div class="card mb-4 border-0 shadow-sm">

            <div class="card-body">

                <h5 class="fw-bold mb-4">
                    Informasi Kost
                </h5>

                {{-- HARGA --}}
                <div class="mb-4">

                    <small class="text-muted d-block mb-1">
                        Harga
                    </small>

                    <h3 class="fw-bold text-primary mb-0">
                        Rp {{ number_format($kost->harga, 0, ',', '.') }}
                    </h3>

                </div>

                {{-- JENIS --}}
                <div class="mb-4">

                    <small class="text-muted d-block mb-1">
                        Jenis Kost
                    </small>

                    <span class="badge bg-primary px-3 py-2">
                        {{ optional($kost->jenis)->jenis_kost }}
                    </span>

                </div>

                {{-- DAERAH --}}
                <div class="mb-4">

                    <small class="text-muted d-block mb-1">
                        Daerah
                    </small>

                    <p class="mb-0 fw-semibold">
                        {{ optional($kost->daerah)->name }}
                    </p>

                </div>

                {{-- ALAMAT --}}
                <div class="mb-4">

                    <small class="text-muted d-block mb-1">
                        Alamat
                    </small>

                    <p class="mb-0">
                        {{ $kost->alamat }}
                    </p>

                </div>

                {{-- FASILITAS --}}
                <div>

                    <small class="text-muted d-block mb-2">
                        Fasilitas
                    </small>

                    @foreach ($kost->fasilitas as $f)

                    <span class="badge bg-success mb-2 px-3 py-2">
                        {{ $f->nama_fasilitas }}
                    </span>

                    @endforeach

                </div>

            </div>

        </div>

        {{-- UPLOAD FOTO --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h5 class="fw-bold mb-3">
                    Upload Foto Baru
                </h5>

                <form action="{{ route('kost-foto.store', $kost->id) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <input type="file"
                        name="foto[]"
                        multiple
                        class="form-control mb-3">

                    <button class="btn btn-primary w-100">
                        Upload Foto
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
