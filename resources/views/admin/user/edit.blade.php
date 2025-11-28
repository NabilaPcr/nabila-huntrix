@extends('layouts.admin.app')
@section('content')
    {{-- start main content  --}}
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Edit User</h1>
                <p class="mb-0">Form untuk mengedit data User.</p>
            </div>
            <div>
                <a href="{{ route('user.index') }}" class="btn btn-primary"><i class="far fa-question-circle me-1"></i>
                    Kembali</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Foto Profil Section -->
                        <div class="row justify-content-center mb-5">
                            <div class="col-lg-6 col-md-8 col-sm-10 text-center">
                                <h5 class="mb-3">Foto Profil</h5>

                                @if ($user->profile_picture)
                                    <img src="{{ asset('assets/img/' . $user->profile_picture) }}" alt="Profile Picture"
                                        class="rounded-circle mb-3" width="150" height="150"
                                        onerror="this.src='https://via.placeholder.com/150'">
                                @else
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mx-auto mb-3"
                                        style="width: 150px; height: 150px;">
                                        <span class="text-white"
                                            style="font-size: 3rem;">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                @endif

                                <!-- INPUT FILE SEDERHANA -->
                                <div class="mb-3">
                                    <input type="file" name="profile_picture" class="form-control">
                                    <small class="text-muted">Pilih file gambar</small>
                                </div>
                            </div>
                        </div>

                        <!-- Form Data -->
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-md-10">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $user->name }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $user->email }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Kosongkan jika tidak ingin mengubah">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Password Confirmation</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end main content  --}}
@endsection
