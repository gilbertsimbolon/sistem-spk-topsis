<div class="row g-4">
    @foreach ($kosts as $kos)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <a href="{{ route('login') }}" class="text-decoration-none text-dark d-block h-100">
                <div class="card border-0 shadow-sm h-100 kost-card">
                    <div class="position-relative">
                        <img src="{{ $kos->foto->isNotEmpty() ? asset('storage/' . $kos->foto->first()->foto) : asset('template/paneladmin/assets/img/background/1.jpg') }}"
                             class="card-img-top kost-img" alt="{{ $kos->nama_kost }}">
                        <span class="badge bg-success position-absolute top-0 start-0 m-2 px-2.5 py-1.5 shadow-sm">
                            {{ $kos->jenis->jenis_kost ?? 'Campur' }}
                        </span>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h6 class="fw-bold text-dark text-truncate mb-1" title="{{ $kos->nama_kost }}">{{ $kos->nama_kost }}</h6>
                            <small class="text-muted d-block mb-2">
                                <i class="bi bi-geo-alt me-1"></i>{{ $kos->daerah->name ?? 'Tidak Ada Daerah' }}
                            </small>
                            <p class="text-secondary small text-truncate mb-3" title="{{ $kos->fasilitas->implode('keterangan', ' • ') }}">
                                {{ $kos->fasilitas->isEmpty() ? 'Fasilitas Standar' : $kos->fasilitas->implode('keterangan', ' • ') }}
                            </p>
                        </div>
                        <h6 class="text-primary fw-bold mb-0">Rp {{ number_format($kos->harga, 0, ',', '.') }}<span class="text-muted fw-normal small">/bln</span></h6>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center mt-5 pagination-ajax">
    {{ $kosts->links() }}
</div>
