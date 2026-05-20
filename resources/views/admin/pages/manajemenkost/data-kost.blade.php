@extends('admin.layouts.app')

@section('title', 'Data Kost | SIPKOST')

@section('content')

    <!-- Tampilan Data Kost -->
    <div class="card mb-4">

        {{-- HEADER --}}
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Kost</h5>

            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCreate">
                + Tambah Kost
            </button>
        </div>

        <div class="card-body">

            <div class="row">

                @foreach ($kost as $k)
                    <div class="col-md-4 mb-4">

                        <div class="card h-100 shadow-sm">

                            {{-- FOTO --}}
                            @if ($k->foto->count())
                                <img src="{{ asset('storage/' . $k->foto->first()->foto) }}" class="card-img-top"
                                    style="height:180px;object-fit:cover;">
                            @else
                                <img src="{{ asset('template/paneladmin/assets/img/background/1.jpg') }}"
                                    class="card-img-top" style="height:180px;object-fit:cover;">
                            @endif

                            <div class="card-body">

                                {{-- NAMA --}}
                                <h5 class="mb-1">{{ $k->nama_kost }}</h5>

                                {{-- ALAMAT --}}
                                <small class="text-muted">{{ $k->alamat }}</small>

                                {{-- JENIS --}}
                                <div class="mt-2">
                                    <span class="badge bg-primary">
                                        {{ optional($k->jenis)->jenis_kost ?? '-' }}
                                    </span>
                                </div>

                                {{-- HARGA --}}
                                <h6 class="mt-2">
                                    Rp {{ number_format($k->harga, 0, ',', '.') }}
                                </h6>

                                {{-- FASILITAS --}}
                                <div class="mt-2">
                                    @foreach ($k->fasilitas as $f)
                                        <span class="badge bg-success mb-1">
                                            {{ $f->nama_fasilitas }}
                                        </span>
                                    @endforeach
                                </div>

                                {{-- ACTION --}}
                                <div class="mt-3 d-flex gap-2">

                                    {{-- EDIT MODAL --}}
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $k->id }}">
                                        Edit
                                    </button>

                                    {{-- DELETE --}}
                                    <form action="{{ route('data-kost.destroy', $k->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">
                                            Hapus
                                        </button>
                                    </form>

                                </div>

                            </div>
                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </div>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="modalCreate" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form action="{{ route('data-kost.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kost</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input type="text" name="nama_kost" class="form-control mb-2" placeholder="Nama Kost">

                        <textarea name="alamat" class="form-control mb-2" placeholder="Alamat"></textarea>

                        <input type="number" name="harga" class="form-control mb-2" placeholder="Harga">

                        <!-- Jenis -->
                        <select name="jenis_kost_id" class="form-control mb-2">
                            @foreach ($jenis as $j)
                                <option value="{{ $j->id }}">
                                    {{ $j->jenis_kost }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Fasilitas -->
                        <label class="mb-1">Fasilitas</label><br>
                        @foreach ($fasilitas as $f)
                            <label class="me-2">
                                <input type="checkbox" name="fasilitas[]" value="{{ $f->id }}">
                                {{ $f->nama_fasilitas }}
                            </label>
                        @endforeach

                        <hr>

                        <!-- Foto -->
                        <input type="file" name="foto[]" multiple class="form-control">

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Simpan</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Modal Edit Data -->
    @foreach ($kost as $k)
        <div class="modal fade" id="modalEdit{{ $k->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <form action="{{ route('data-kost.update', $k->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title">Edit Kost</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            {{-- Nama Kost --}}
                            <input type="text" name="nama_kost" value="{{ $k->nama_kost }}" class="form-control mb-2">

                            {{-- Alamat --}}
                            <textarea name="alamat" class="form-control mb-2">{{ $k->alamat }}</textarea>

                            {{-- Harga --}}
                            <input type="number" name="harga" value="{{ $k->harga }}" class="form-control mb-2">

                            {{-- Jenis Kost --}}
                            <select name="jenis_kost_id" class="form-control mb-2">
                                @foreach ($jenis as $j)
                                    <option value="{{ $j->id }}" @if ($k->jenis_kost_id == $j->id) selected @endif>
                                        {{ $j->jenis_kost }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- Fasilitas --}}
                            <label class="mb-1">Fasilitas</label><br>
                            @foreach ($fasilitas as $f)
                                <label class="me-2">
                                    <input type="checkbox" name="fasilitas[]" value="{{ $f->id }}"
                                        @if ($k->fasilitas->contains($f->id)) checked @endif>
                                    {{ $f->nama_fasilitas }}
                                </label>
                            @endforeach

                            <hr>

                            {{-- Foto Lama --}}
                            <label class="mb-1">Foto Saat Ini</label>
                            <div class="d-flex flex-wrap mb-2">
                                @foreach ($k->foto as $foto)
                                    <div class="position-relative me-2 mb-2" style="width:120px;">
                                        <img src="{{ asset('storage/' . $foto->foto) }}" class="img-thumbnail"
                                            style="width:120px; height:100px; object-fit:cover;">
                                        {{-- Tombol Hapus Foto Lama --}}
                                        <form action="{{ route('kost-foto.destroy', $foto->id) }}" method="POST"
                                            class="position-absolute top-0 end-0 m-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin hapus foto?')">&times;</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>

                            <hr>

                            {{-- Upload Foto Baru --}}
                            <label class="mb-1">Upload Foto Baru</label>
                            <input type="file" id="foto-new-{{ $k->id }}" multiple class="form-control">

                            {{-- Preview Foto Baru --}}
                            <div class="d-flex flex-wrap mt-2" id="preview-foto-{{ $k->id }}"></div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-success">Update</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach

    <script>
        const newFotos = {}; // menampung file baru per kostId

        function handleNewFoto(input, kostId) {
            if (!newFotos[kostId]) newFotos[kostId] = [];
            const previewContainer = document.getElementById('preview-foto-' + kostId);

            Array.from(input.files).forEach(file => {
                newFotos[kostId].push(file);
                const index = newFotos[kostId].length - 1;

                const div = document.createElement('div');
                div.style.position = 'relative';
                div.style.marginRight = '0.5rem';
                div.style.marginBottom = '0.5rem';
                div.style.width = '120px';
                div.style.height = '100px';
                div.dataset.index = index;

                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'cover';
                img.classList.add('img-thumbnail');

                // tombol hapus preview
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.innerHTML = '&times;';
                btn.className = 'btn btn-sm btn-danger position-absolute top-0 end-0 m-1';
                btn.onclick = () => {
                    newFotos[kostId].splice(index, 1);
                    div.remove();
                };

                div.appendChild(img);
                div.appendChild(btn);
                previewContainer.appendChild(div);
            });

            // kosongkan input supaya bisa pilih ulang
            input.value = '';
        }

        // pasang event listener untuk semua input file
        @foreach ($kost as $k)
            document.getElementById('foto-new-{{ $k->id }}').addEventListener('change', function() {
                handleNewFoto(this, {{ $k->id }});
            });
        @endforeach
    </script>
@endsection
