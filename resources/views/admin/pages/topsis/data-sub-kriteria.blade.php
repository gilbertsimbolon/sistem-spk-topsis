@extends('admin.layouts.app')

@section('title', 'Data Sub Kriteria | SIPKOS')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
            <h5 class="mb-0 fw-bold text-dark">Data Sub Kriteria TOPSIS</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubKriteriaModal">
                <i class="bi bi-plus-circle me-1"></i> Tambah Sub Kriteria
            </button>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <ul class="nav nav-tabs mb-4" id="kriteriaTab" role="tablist">
                @foreach ($criterias as $index => $c)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $index === 0 ? 'active fw-bold text-primary' : 'text-secondary' }}"
                            id="tab-{{ $c->id }}" data-bs-toggle="tab" data-bs-target="#content-{{ $c->id }}"
                            type="button" role="tab" aria-controls="content-{{ $c->id }}"
                            aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                            {{ $c->nama_kriteria }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content" id="kriteriaTabContent">
                @foreach ($criterias as $index => $c)
                    @php
                        $namaKriteriaClean = strtolower(trim($c->nama_kriteria));
                    @endphp
                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="content-{{ $c->id }}"
                        role="tabpanel" aria-labelledby="tab-{{ $c->id }}">

                        <div class="table-responsive">
                            <table class="table table-striped align-middle border">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 30%">Rentang Nilai Riil</th>
                                        <th>Keterangan Sub Kriteria</th>
                                        <th style="width: 15%">Nilai (Skala)</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $filteredSubs = $subCriterias->where('criteria_id', $c->id);
                                        $no = 1;
                                    @endphp

                                    @if ($filteredSubs->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">Belum ada data sub
                                                kriteria untuk kriteria {{ $c->nama_kriteria }}.</td>
                                        </tr>
                                    @else
                                        @foreach ($filteredSubs as $s)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>
                                                    @if ($s->nilai_minimum !== null || $s->nilai_maksimum !== null)
                                                        <span class="badge bg-light text-dark border py-2 px-3 fs-7">
                                                            @if ($namaKriteriaClean === 'harga')
                                                                Rp {{ number_format($s->nilai_minimum, 0, ',', '.') }} - Rp {{ number_format($s->nilai_maksimum, 0, ',', '.') }}
                                                            @elseif (in_array($namaKriteriaClean, ['fasilitas', 'keamanan', 'kebersihan']))
                                                                {{ $s->nilai_minimum }}% - {{ $s->nilai_maksimum }}%
                                                            @elseif ($namaKriteriaClean === 'jarak')
                                                                {{ number_format($s->nilai_minimum, 0, ',', '.') }} m - {{ number_format($s->nilai_maksimum, 0, ',', '.') }} m
                                                            @else
                                                                {{ number_format($s->nilai_minimum, 0, ',', '.') }} - {{ number_format($s->nilai_maksimum, 0, ',', '.') }}
                                                            @endif
                                                        </span>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td><span class="fw-semibold">{{ $s->keterangan }}</span></td>
                                                <td><span class="badge bg-primary px-3 py-2 fs-6">{{ $s->nilai }}</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal"
                                                        data-bs-target="#editSubKriteriaModal{{ $s->id }}">Edit</button>

                                                    <form action="{{ route('sub-kriteria.destroy', $s->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin ingin menghapus sub kriteria ini?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="editSubKriteriaModal{{ $s->id }}"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('sub-kriteria.update', $s->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Sub Kriteria: {{ $c->nama_kriteria }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="criteria_id" value="{{ $s->criteria_id }}">

                                                                <div class="row mb-3">
                                                                    <div class="col-6">
                                                                        <label class="form-label">
                                                                            Nilai Minimum 
                                                                            @if($namaKriteriaClean === 'harga') (Rp) @elseif(in_array($namaKriteriaClean, ['fasilitas', 'keamanan', 'kebersihan'])) (%) @elseif($namaKriteriaClean === 'jarak') (m) @endif
                                                                        </label>
                                                                        <input type="number" name="nilai_minimum" class="form-control" value="{{ $s->nilai_minimum }}" required>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label class="form-label">
                                                                            Nilai Maksimum 
                                                                            @if($namaKriteriaClean === 'harga') (Rp) @elseif(in_array($namaKriteriaClean, ['fasilitas', 'keamanan', 'kebersihan'])) (%) @elseif($namaKriteriaClean === 'jarak') (m) @endif
                                                                        </label>
                                                                        <input type="number" name="nilai_maksimum" class="form-control" value="{{ $s->nilai_maksimum }}" required>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Keterangan Sub Kriteria</label>
                                                                    <input type="text" name="keterangan" class="form-control" value="{{ $s->keterangan }}" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Nilai / Bobot Sub</label>
                                                                    <input type="number" name="nilai" class="form-control" value="{{ $s->nilai }}" min="1" max="5" required>
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
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                @endforeach
            </div>
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
                            <select name="criteria_id" id="selectKriteriaUtama" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Kriteria --</option>
                                @foreach ($criterias as $c)
                                    <option value="{{ $c->id }}" data-nama="{{ strtolower(trim($c->nama_kriteria)) }}">{{ $c->nama_kriteria }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row mb-3 d-none" id="inputRentangWrapper">
                            <div class="col-6">
                                <label class="form-label" id="labelMin">Nilai Minimum</label>
                                <input type="number" name="nilai_minimum" id="nilaiMinimum" class="form-control" placeholder="0">
                            </div>
                            <div class="col-6">
                                <label class="form-label" id="labelMax">Nilai Maksimum</label>
                                <input type="number" name="nilai_maksimum" id="nilaiMaksimum" class="form-control" placeholder="100">
                            </div>
                            <small class="text-muted mt-1 d-none" id="hintPersen">💡 Masukkan angka persentase rentang (Contoh: Min 81, Max 100)</small>
                        </div>

                        <div class="mb-3 d-none" id="dropdownKeteranganWrapper">
                            <label class="form-label">Label Keterangan Sub Kriteria</label>
                            <select name="keterangan" id="namaSubManual" class="form-select"></select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nilai Bobot TOPSIS (Skala 1 - 5)</label>
                            <select name="nilai" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Skala Nilai --</option>
                                <option value="5">5 (Sangat Baik / Sangat Murah / Sangat Lengkap)</option>
                                <option value="4">4 (Baik / Murah / Lengkap)</option>
                                <option value="3">3 (Cukup)</option>
                                <option value="2">2 (Kurang / Buruk)</option>
                                <option value="1">1 (Sangat Kurang / Sangat Buruk)</option>
                            </select>
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

    <script>
        const opsiKeterangan = {
            harga: ["Sangat Murah", "Murah", "Cukup", "Mahal", "Sangat Mahal"],
            jarak: ["Sangat Dekat", "Dekat", "Cukup Dekat", "Jauh", "Sangat Jauh"],
            fasilitas: ["Sangat Lengkap", "Lengkap", "Cukup Lengkap", "Kurang Lengkap", "Tidak Lengkap"],
            keamanan: ["Sangat Aman", "Aman", "Cukup Aman", "Kurang Aman", "Tidak Aman"],
            kebersihan: ["Sangat Bersih", "Bersih", "Cukup Bersih", "Kurang Bersih", "Kotor"]
        };

        document.getElementById('selectKriteriaUtama').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var namaKriteria = selectedOption.getAttribute('data-nama').trim();

            var rentangWrapper = document.getElementById('inputRentangWrapper');
            var keteranganWrapper = document.getElementById('dropdownKeteranganWrapper');
            var hintPersen = document.getElementById('hintPersen');

            var nilaiMinimum = document.getElementById('nilaiMinimum');
            var nilaiMaksimum = document.getElementById('nilaiMaksimum');
            var selectKeterangan = document.getElementById('namaSubManual');

            rentangWrapper.classList.add('d-none');
            keteranganWrapper.classList.add('d-none');
            hintPersen.classList.add('d-none');

            nilaiMinimum.removeAttribute('required');
            nilaiMaksimum.removeAttribute('required');
            selectKeterangan.removeAttribute('required');

            nilaiMinimum.value = "";
            nilaiMaksimum.value = "";
            selectKeterangan.innerHTML = '';

            if (opsiKeterangan[namaKriteria]) {
                rentangWrapper.classList.remove('d-none');
                keteranganWrapper.classList.remove('d-none');
                
                nilaiMinimum.setAttribute('required', 'required');
                nilaiMaksimum.setAttribute('required', 'required');
                selectKeterangan.setAttribute('required', 'required');

                selectKeterangan.innerHTML = `<option value="" disabled selected>-- Pilih Keterangan ${selectedOption.text} --</option>`;
                opsiKeterangan[namaKriteria].forEach(function(item) {
                    var option = document.createElement('option');
                    option.value = item;
                    option.text = item;
                    selectKeterangan.appendChild(option);
                });

                if (['fasilitas', 'keamanan', 'kebersihan'].includes(namaKriteria)) {
                    hintPersen.classList.remove('d-none');
                    nilaiMinimum.placeholder = "0";
                    nilaiMaksimum.placeholder = "100";
                } else if (namaKriteria === 'harga') {
                    nilaiMinimum.placeholder = "Contoh: 0";
                    nilaiMaksimum.placeholder = "Contoh: 300000";
                } else {
                    nilaiMinimum.placeholder = "Dalam meter. Contoh: 0";
                    nilaiMaksimum.placeholder = "Dalam meter. Contoh: 500";
                }
            }
        });

        var tabEl = document.querySelectorAll('button[data-bs-toggle="tab"]')
        tabEl.forEach(function(el) {
            el.addEventListener('shown.bs.tab', function(event) {
                tabEl.forEach(tab => tab.classList.remove('fw-bold', 'text-primary'));
                event.target.classList.add('fw-bold', 'text-primary');
            })
        });
    </script>
@endsection