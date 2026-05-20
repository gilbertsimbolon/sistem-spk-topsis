@extends('admin.layouts.app')

@section('title', 'Semua User | SIPKOS')

@section('content')

<!-- helper untuk mengubah data dari kolom fakultas -->
@php
$fakultasList = [
'fatek' => 'Teknik',
'fish' => 'Ilmu Sosial dan Hukum',
'feb' => 'Ekonomi dan Bisnis',
'fikkm' => 'Ilmu Keolahragaan dan Kesehatan Masyarakat',
'fbs' => 'Bahasa dan Seni',
'fipp' => 'Ilmu Pendidikan dan Psikologi',
'fke' => 'Kedokteran',
];
@endphp

<!-- Tabel Utama -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Semua User</h5>

        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCreate">
            + Tambah User
        </button>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Fakultas</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @forelse ($users as $user)
                <tr>

                    <!-- Iterasi -->
                    <td>
                        {{ $users->firstItem() + $loop->index }}
                    </td>

                    <!-- Nama -->
                    <td>
                        <strong>{{ $user->name }}</strong>
                    </td>

                    <!-- Fakultas -->
                    <td>
                        {{ $fakultasList[$user->fakultas] ?? '-' }}
                    </td>

                    <!-- Email -->
                    <td>
                        {{ $user->email }}
                    </td>

                    <!-- Role -->
                    <td>
                        <span class="badge bg-label-primary">
                            {{ ucfirst($user->role) }}
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

                                <a class="dropdown-item" href="{{ route('semua-user.update', $user->id) }}" data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $user->id }}">
                                    <i class="icon-base bx bx-edit-alt me-1"></i>
                                    Edit
                                </a>

                                <a class="dropdown-item" href="#">
                                    <i class="icon-base bx bx-trash me-1"></i>
                                    Delete
                                </a>

                            </div>

                        </div>
                    </td>

                </tr>
                @empty

                <tr>
                    <td colspan="5" class="text-center py-4">
                        Tidak ada data user
                    </td>
                </tr>

                @endforelse

            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-4 px-3">
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="{{ route('semua-user.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
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
                    <div class="mb-3">

                        <label class="form-label">
                            Fakultas
                        </label>

                        <div class="input-group input-group-merge">

                            <span class="input-group-text">
                                <i class="icon-base bx bx-buildings"></i>
                            </span>

                            <select
                                name="fakultas"
                                class="form-select">

                                <option value="">Pilih Fakultas</option>

                                <option value="fatek">
                                    Fakultas Teknik
                                </option>

                                <option value="fish">
                                    Fakultas Ilmu Sosial dan Hukum
                                </option>

                                <option value="feb">
                                    Fakultas Ekonomi dan Bisnis
                                </option>

                                <option value="fikkm">
                                    Fakultas Ilmu Keolahragaan dan Kesehatan Masyarakat
                                </option>

                                <option value="fbs">
                                    Fakultas Bahasa dan Seni
                                </option>

                                <option value="fipp">
                                    Fakultas Ilmu Pendidikan dan Psikologi
                                </option>

                                <option value="fke">
                                    Fakultas Kedokteran
                                </option>

                            </select>

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
                                value="User"
                                disabled>

                            <input type="hidden" name="role" value="user">
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
@foreach ($users as $u)
<div class="modal fade" id="modalEdit{{ $u->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="{{ route('semua-user.update', $u->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
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
                                placeholder="{{$u->name}}"
                                aria-label="John Doe"
                                aria-describedby="basic-icon-default-fullname2" />
                        </div>
                    </div>
                    <div class="mb-3">

                        <label class="form-label">
                            Fakultas
                        </label>

                        <div class="input-group input-group-merge">

                            <span class="input-group-text">
                                <i class="icon-base bx bx-buildings"></i>
                            </span>

                            <select
                                name="fakultas"
                                class="form-select">

                                <option value="">Pilih Fakultas</option>

                                <option value="fatek" {{ $u->fakultas == 'fatek' ? 'selected' : '' }}>
                                    Fakultas Teknik
                                </option>

                                <option value="fish" {{ $u->fakultas == 'fish' ? 'selected' : '' }}>
                                    Fakultas Ilmu Sosial dan Hukum
                                </option>

                                <option value="feb" {{ $u->fakultas == 'feb' ? 'selected' : '' }}>
                                    Fakultas Ekonomi dan Bisnis
                                </option>

                                <option value="fikkm" {{ $u->fakultas == 'fikkm' ? 'selected' : '' }}>
                                    Fakultas Ilmu Keolahragaan dan Kesehatan Masyarakat
                                </option>

                                <option value="fbs" {{ $u->fakultas == 'fbs' ? 'selected' : '' }}>
                                    Fakultas Bahasa dan Seni
                                </option>

                                <option value="fipp" {{ $u->fakultas == 'fipp' ? 'selected' : '' }}>
                                    Fakultas Ilmu Pendidikan dan Psikologi
                                </option>

                                <option value="fke" {{ $u->fakultas == 'fke' ? 'selected' : '' }}>
                                    Fakultas Kedokteran
                                </option>

                            </select>

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
                                placeholder="{{$u->email}}"
                                aria-label="{{$u->email}}"
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
                                value="User"
                                disabled>

                            <input type="hidden" name="role" value="user">
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