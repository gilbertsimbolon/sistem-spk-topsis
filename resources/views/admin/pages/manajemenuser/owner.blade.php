@extends('admin.layouts.app')

@section('title', 'Owner | SIPKOS')

@section('content')

<!-- Tabel Utama -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Owner</h5>

        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCreate">
            + Tambah Owner
        </button>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @forelse ($owners as $owner)
                <tr>

                    <!-- Iterasi -->
                    <td>
                        {{ $owners->firstItem() + $loop->index }}
                    </td>

                    <!-- Nama -->
                    <td>
                        <strong>{{ $owner->name }}</strong>
                    </td>

                    <!-- Email -->
                    <td>
                        {{ $owner->email }}
                    </td>

                    <!-- Role -->
                    <td>
                        <span class="badge bg-label-primary">
                            {{ ucfirst($owner->role) }}
                        </span>
                    </td>

                    <!-- Action -->
                    <td>
                        <div class="dropdown">

                            <button type="button"
                                class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown">

                                <i class="icon-base bx bx-dots-vertical-rounded"></i>

                            </button>

                            <div class="dropdown-menu">

                                <a class="dropdown-item" href="{{ route('owner.update', $owner->id) }}" data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $owner->id }}">
                                    <i class="icon-base bx bx-edit-alt me-1"></i>
                                    Edit
                                </a>

                                <form action="{{ route('owner.destroy', $owner->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item">
                                        <i class="icon-base bx bx-trash me-1"></i>
                                        Delete
                                    </button>
                                </form>

                            </div>

                        </div>
                    </td>

                </tr>
                @empty

                <tr>
                    <td colspan="5" class="text-center py-4">
                        Tidak ada data owner
                    </td>
                </tr>

                @endforelse

            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-4 px-3">
            {{ $owners->links() }}
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="{{ route('owner.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Owner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-6">
                        <label class="form-label" for="basic-icon-default-fullname" name="name">Nama Lengkap</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="icon-base bx bx-user"></i></span>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                id="basic-icon-default-fullname"
                                placeholder="John Doe"
                                aria-label="John Doe"
                                aria-describedby="basic-icon-default-fullname2" />
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="basic-icon-default-email" name="email">Email</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="icon-base bx bx-envelope"></i></span>
                            <input
                                type="text"
                                name="email"
                                id="basic-icon-default-email"
                                class="form-control"
                                placeholder="john.doe"
                                aria-label="john.doe"
                                aria-describedby="basic-icon-default-email2" />
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="basic-icon-default-lock" name="password">Password</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-lock2" class="input-group-text"><i class="icon-base bx bx-lock-alt"></i></span>
                            <input
                                type="text"
                                name="password"
                                id="basic-icon-default-lock"
                                class="form-control phone-mask"
                                placeholder="Masukkan password"
                                aria-label="Masukkan password"
                                aria-describedby="basic-icon-default-lock2" />
                        </div>
                        <div class="mb-0 mt-6">
                            <label class="form-label">Role</label>

                            <input type="text"
                                class="form-control"
                                value="Owner"
                                disabled>

                            <input type="hidden" name="role" value="owner">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Modal Edit Data -->
@foreach ($owners as $o)
<div class="modal fade" id="modalEdit{{ $o->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="{{ route('owner.update', $o->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Owner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-6">
                        <label class="form-label" for="basic-icon-default-fullname" name="name">Nama Lengkap</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="icon-base bx bx-user"></i></span>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                id="basic-icon-default-fullname"
                                placeholder="{{$o->name}}"
                                value="{{$o->name}}"
                                aria-label="John Doe"
                                aria-describedby="basic-icon-default-fullname2" />
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="basic-icon-default-email" name="email">Email</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="icon-base bx bx-envelope"></i></span>
                            <input
                                type="text"
                                name="email"
                                id="basic-icon-default-email"
                                class="form-control"
                                placeholder="{{$o->email}}"
                                value="{{$o->email}}"
                                aria-label="{{$o->email}}"
                                aria-describedby="basic-icon-default-email2" />
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="basic-icon-default-lock" name="password">Password</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-lock2" class="input-group-text"><i class="icon-base bx bx-lock-alt"></i></span>
                            <input
                                type="text"
                                name="password"
                                id="basic-icon-default-lock"
                                class="form-control phone-mask"
                                placeholder="Masukkan password"
                                aria-label="Masukkan password"
                                aria-describedby="basic-icon-default-lock2" />
                        </div>
                        <div class="mb-0 mt-6">
                            <label class="form-label">Role</label>

                            <input type="text"
                                class="form-control"
                                value="Owner"
                                disabled>

                            <input type="hidden" name="role" value="owner">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endforeach
@endsection