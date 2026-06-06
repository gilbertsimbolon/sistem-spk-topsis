@extends('layouts.app')

@section('title', 'Dashboard | Sistem Pemilihan Kost')

@section('content')
    <style>
        .kost-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .kost-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .kost-img {
            height: 180px;
            object-fit: cover;
        }

        .criteria-box {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            border: 1px solid #e9ecef;
            height: 100%;
        }
    </style>

    <div class="py-4">

        {{-- Section 1: TOPSIS Recommendations --}}
        <div class="container mb-5">
            <div class="mb-4">
                <h4 class="fw-bold text-dark mb-1"><i class="bi bi-award text-warning me-2"></i>8 Kost Terbaik Berdasarkan
                    Hasil TOPSIS</h4>
            </div>

            <div class="row g-4">
                @foreach ($kostsTopsis ?? [] as $kos)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="{{ route('dashboard.kost.show', $kos->id) }}"
                            class="text-decoration-none text-dark d-block h-100">
                            <div class="card border-0 shadow-sm h-100 kost-card">
                                <div class="position-relative">
                                    <img src="{{ $kos->foto->isNotEmpty() ? asset('storage/' . $kos->foto->first()->foto) : asset('template/paneladmin/assets/img/background/1.jpg') }}"
                                        class="card-img-top kost-img" alt="{{ $kos->nama_kost }}">
                                    <span
                                        class="badge bg-warning position-absolute top-0 start-0 m-2 px-2.5 py-1.5 shadow-sm text-dark fw-bold">
                                        Rekomendasi
                                    </span>
                                </div>
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h6 class="fw-bold text-dark text-truncate mb-1" title="{{ $kos->nama_kost }}">
                                            {{ $kos->nama_kost }}</h6>
                                        <small class="text-muted d-block mb-2">
                                            <i class="bi bi-geo-alt me-1"></i>{{ $kos->daerah->name ?? 'Tidak Ada Daerah' }}
                                        </small>
                                        <p class="text-secondary small text-truncate mb-3"
                                            title="{{ $kos->fasilitas->implode('keterangan', ' • ') }}">
                                            {{ $kos->fasilitas->isEmpty() ? 'Fasilitas Standar' : $kos->fasilitas->implode('keterangan', ' • ') }}
                                        </p>
                                    </div>
                                    <h6 class="text-primary fw-bold mb-0">Rp
                                        {{ number_format($kos->harga, 0, ',', '.') }}<span
                                            class="text-muted fw-normal small">/bln</span></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Section 2: Search Filter Form --}}
        <div class="container mb-5 mt-4">
            <div class="card border-0 shadow-sm border-start border-success border-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 text-dark">
                        <i class="bi bi-search me-2 text-success"></i>Filter Pencarian Kost
                    </h5>

                    <form id="filterForm" action="{{ route('dashboard.index') }}" method="GET">
                        <div class="row g-3 align-items-end">

                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary">Daerah / Wilayah</label>
                                <select class="form-select filter-input" name="daerah_kost_id" id="daerahSelect">
                                    <option value="">Semua Daerah</option>
                                    @foreach ($daerah ?? [] as $d)
                                        <option value="{{ $d->id }}"
                                            {{ request('daerah_kost_id') == $d->id ? 'selected' : '' }}>
                                            {{ $d->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary">Jenis Kost</label>
                                <select class="form-select filter-input" name="tipe_kost">
                                    <option value="">Semua jenis</option>
                                    @foreach ($jenis ?? [] as $j)
                                        <option value="{{ $j->id }}"
                                            {{ request('tipe_kost') == $j->id ? 'selected' : '' }}>
                                            {{ $j->jenis_kost }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary">Harga Minimal</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-wallet2 text-muted"></i></span>
                                    <input type="text" id="harga_minimal" name="harga_minimal"
                                        class="form-control rupiah-field filter-input"
                                        value="{{ request('harga_minimal') ? 'Rp ' . number_format(request('harga_minimal'), 0, ',', '.') : '' }}"
                                        placeholder="Contoh: Rp 300.000">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary">Harga Maksimal</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-wallet2 text-muted"></i></span>
                                    <input type="text" id="harga_maksimal" name="harga_maksimal"
                                        class="form-control rupiah-field filter-input"
                                        value="{{ request('harga_maksimal') ? 'Rp ' . number_format(request('harga_maksimal'), 0, ',', '.') : '' }}"
                                        placeholder="Contoh: Rp 1.000.000">
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <button class="btn btn-sm btn-outline-success fw-semibold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseKriteria" aria-expanded="false"
                                    aria-controls="collapseKriteria">
                                    <i class="bi bi-sliders me-1"></i> Pengaturan Kriteria Tambahan
                                </button>
                            </div>

                            <div class="collapse col-12 {{ request('fasilitas') || request('keamanan') || request('kebersihan') ? 'show' : '' }}"
                                id="collapseKriteria">
                                <div class="row g-3 pt-2">

                                    <div class="col-md-4">
                                        <div class="criteria-box shadow-sm">
                                            <label class="form-label small fw-bold text-success mb-2 d-block"><i
                                                    class="bi bi-house-heart me-1"></i>Fasilitas Kamar</label>
                                            <div style="max-height: 150px; overflow-y: auto; padding-right: 5px;">
                                                @foreach ($fasilitas ?? [] as $f)
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input filter-input" type="checkbox"
                                                            name="fasilitas[]" value="{{ $f->id }}"
                                                            id="f-{{ $f->id }}"
                                                            {{ is_array(request('fasilitas')) && in_array($f->id, request('fasilitas')) ? 'checked' : '' }}>
                                                        <label class="form-check-label small text-dark"
                                                            for="f-{{ $f->id }}">{{ $f->keterangan }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="criteria-box shadow-sm">
                                            <label class="form-label small fw-bold text-primary mb-2 d-block"><i
                                                    class="bi bi-shield-check me-1"></i>Sistem Keamanan</label>
                                            <div style="max-height: 150px; overflow-y: auto; padding-right: 5px;">
                                                @foreach ($keamanan ?? [] as $k)
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input filter-input" type="checkbox"
                                                            name="keamanan[]" value="{{ $k->id }}"
                                                            id="k-{{ $k->id }}"
                                                            {{ is_array(request('keamanan')) && in_array($k->id, request('keamanan')) ? 'checked' : '' }}>
                                                        <label class="form-check-label small text-dark"
                                                            for="k-{{ $k->id }}">{{ $k->keterangan }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="criteria-box shadow-sm">
                                            <label class="form-label small fw-bold text-warning mb-2 d-block"><i
                                                    class="bi bi-sparkles me-1"></i>Kebersihan</label>
                                            <div style="max-height: 150px; overflow-y: auto; padding-right: 5px;">
                                                @foreach ($kebersihan ?? [] as $b)
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input filter-input" type="checkbox"
                                                            name="kebersihan[]" value="{{ $b->id }}"
                                                            id="b-{{ $b->id }}"
                                                            {{ is_array(request('kebersihan')) && in_array($b->id, request('kebersihan')) ? 'checked' : '' }}>
                                                        <label class="form-check-label small text-dark"
                                                            for="b-{{ $b->id }}">{{ $b->keterangan }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 text-end mt-4 d-flex justify-content-end gap-2">
                                <a href="{{ route('dashboard.index') }}" class="btn btn-outline-secondary px-4">Reset</a>
                                <button type="submit" class="btn btn-success px-4 fw-bold shadow-sm">
                                    <i class="bi bi-search me-2"></i>Cari Kost
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Section 3: All Kost Container (Target AJAX) --}}
        <div class="container mb-5" id="dashboard-kost-section">
            <div class="mb-4">
                <h5 class="fw-bold text-dark mb-1">Seluruh Kamar Kost</h5>
            </div>

            <div id="ajax-dashboard-kost">
                <div class="row g-4">
                    @forelse ($kosts as $kos)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <a href="{{ route('dashboard.kost.show', $kos->id) }}"
                                class="text-decoration-none text-dark d-block h-100">
                                <div class="card border-0 shadow-sm h-100 kost-card">
                                    <div class="position-relative">
                                        <img src="{{ $kos->foto->isNotEmpty() ? asset('storage/' . $kos->foto->first()->foto) : asset('template/paneladmin/assets/img/background/1.jpg') }}"
                                            class="card-img-top kost-img" alt="{{ $kos->nama_kost }}">
                                        <span
                                            class="badge bg-success position-absolute top-0 start-0 m-2 px-2.5 py-1.5 shadow-sm">
                                            {{ $kos->jenis->jenis_kost ?? 'Campur' }}
                                        </span>
                                    </div>
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <h6 class="fw-bold text-dark text-truncate mb-1"
                                                title="{{ $kos->nama_kost }}">{{ $kos->nama_kost }}</h6>
                                            <small class="text-muted d-block mb-2">
                                                <i
                                                    class="bi bi-geo-alt me-1"></i>{{ $kos->daerah->name ?? 'Tidak Ada Daerah' }}
                                            </small>
                                            <p class="text-secondary small text-truncate mb-3"
                                                title="{{ $kos->fasilitas->implode('keterangan', ' • ') }}">
                                                {{ $kos->fasilitas->isEmpty() ? 'Fasilitas Standar' : $kos->fasilitas->implode('keterangan', ' • ') }}
                                            </p>
                                        </div>
                                        <h6 class="text-primary fw-bold mb-0">Rp
                                            {{ number_format($kos->harga, 0, ',', '.') }}<span
                                                class="text-muted fw-normal small">/bln</span></h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="bi bi-house-x text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2 mb-0">Tidak ada kamar kost yang cocok dengan kriteria filter Anda.
                            </p>
                        </div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-center mt-5 pagination-ajax">
                    {{ $kosts->appends(request()->query())->links() }}
                </div>
            </div>
        </div>

    </div>

    {{-- Script Logika Filter & AJAX --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById('ajax-dashboard-kost');
            const filterForm = document.getElementById('filterForm');

            // 1. Memperbaiki Event Delegation pada Pagination agar tetap bekerja setelah DOM di-replace
            document.addEventListener('click', function(e) {
                const targetLink = e.target.closest('#ajax-dashboard-kost .pagination a');
                if (targetLink) {
                    e.preventDefault();
                    fetchData(targetLink.getAttribute('href'));
                }
            });

            // 2. Handler untuk Submit Form Filter
            filterForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const baseUrl = this.getAttribute('action');
                const params = new URLSearchParams();

                // Menggunakan FormData untuk memudahkan penanganan struktur array input checkbox []
                const formData = new FormData(filterForm);

                for (let [key, value] of formData.entries()) {
                    if (value !== "") {
                        // Jika field harga murni (rupiah), hapus karakter teks 'Rp' dan titik (.) sebelum dikirim
                        if (key === 'harga_minimal' || key === 'harga_maksimal') {
                            value = value.replace(/\D/g, '');
                        }
                        // Append jika valuenya ada nilainya
                        if (value !== "") {
                            params.append(key, value);
                        }
                    }
                }

                fetchData(`${baseUrl}?${params.toString()}`);
            });

            // 3. Fungsi Utama AJAX Fetch Data
            function fetchData(url) {
                if (!url) return;
                container.style.opacity = '0.5';

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.text();
                    })
                    .then(html => {
                        // Tempel HTML baru hasil render partial dari controller
                        container.innerHTML = html;
                        container.style.opacity = '1';

                        // Scroll halus otomatis ke batas daftar kost agar user sadar data berubah
                        document.getElementById('dashboard-kost-section').scrollIntoView({
                            behavior: 'smooth'
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching filtered data:', error);
                        container.style.opacity = '1';
                    });
            }
        });
    </script>

    {{-- Script Masking Format Rupiah Otomatis --}}
    <script>
        document.querySelectorAll('.rupiah-field').forEach(function(input) {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                let formatted = new Intl.NumberFormat('id-ID').format(value);
                e.target.value = value ? 'Rp ' + formatted : '';
            });
        });
    </script>
@endsection
