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
                    <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between w-100 flex-wrap">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">Tambah User</h1>
                    <p class="mb-0">Form untuk menambahkan data User baru.</p>
                </div>
                <div>
                    <a href="{{ route('user.index') }}" class="btn btn-primary"><i
                            class="far fa-question-circle me-1"></i> Kembali</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Foto Profil Section - Di Tengah seperti edit -->
                            <div class="row justify-content-center mb-5">
                                <div class="col-lg-6 col-md-8 col-sm-10 text-center">
                                    <h5 class="mb-3">Foto Profil</h5>

                                    <!-- Placeholder Avatar untuk Create -->
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mx-auto mb-3"
                                         style="width: 150px; height: 150px;">
                                        <span class="text-white" style="font-size: 3rem;">?</span>
                                    </div>
                                    <p class="text-muted mb-3">Upload foto profil untuk user baru</p>

                                    <div class="mb-3">
                                        <input type="file" id="profile_picture" name="profile_picture"
                                               class="form-control" accept="image/*">
                                        <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF (Maks. 2MB)</small>
                                        @error('profile_picture')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Form Data Section - Di Bawah Foto Profil -->
                            <div class="row justify-content-center">
                                <div class="col-lg-8 col-md-10">
                                    <div class="row">
                                        <!-- Name -->
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Nama Lengkap</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                   value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" id="email" class="form-control" name="email"
                                                   value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Password -->
                                        <div class="col-md-6 mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" id="password" class="form-control" name="password" required>
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Password Confirmation -->
                                        <div class="col-md-6 mb-3">
                                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                            <input type="password" id="password_confirmation" class="form-control"
                                                   name="password_confirmation" required>
                                            @error('password_confirmation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="row">
                                        <div class="col-12 text-center mt-4">
                                            <button type="submit" class="btn btn-primary">
                                                <svg class="icon icon-xs me-2" data-slot="icon" fill="none"
                                                    stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                Simpan User
                                            </button>
                                            <a href="{{ route('user.index') }}"
                                                class="btn btn-outline-secondary ms-2">Batal</a>
                                        </div>
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
