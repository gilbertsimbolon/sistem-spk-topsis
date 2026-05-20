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

<div class="card mb-4">
    <div class="card">
        <h5 class="card-header">Semua User</h5>
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

                                    <a class="dropdown-item" href="#">
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
</div>
@endsection