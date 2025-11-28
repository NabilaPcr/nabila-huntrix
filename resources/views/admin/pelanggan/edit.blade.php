@extends('layouts.admin.app')
@section('content')
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
                <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Edit Pelanggan</h1>
                <p class="mb-0">Form untuk mengedit data pelanggan.</p>
            </div>
            <div>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-primary"><i
                        class="far fa-question-circle me-1"></i> Kembali</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    <form action="{{ route('pelanggan.update', $dataPelanggan->pelanggan_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-lg-4 col-sm-6">
                                <!-- First Name -->
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First name</label>
                                    <input type="text" id="first_name" name="first_name"
                                        class="form-control" value="{{ $dataPelanggan->first_name }}" required>
                                </div>

                                <!-- Last Name -->
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control"
                                        value="{{ $dataPelanggan->last_name }}" required>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <!-- Birthday -->
                                <div class="mb-3">
                                    <label for="birthday" class="form-label">Birthday</label>
                                    <input type="date" name="birthday" id="birthday"
                                        value="{{ $dataPelanggan->birthday }}" class="form-control">
                                </div>

                                <!-- Gender -->
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select mb-0" id="gender" name="gender"
                                        aria-label="Gender select example">
                                        <option value="">Pilih Gender</option>
                                        <option value="Female" {{ $dataPelanggan->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Male" {{ $dataPelanggan->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Other" {{ $dataPelanggan->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-12">
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" id="email" class="form-control" name="email"
                                        value="{{ $dataPelanggan->email }}" required>
                                </div>

                                <!-- Phone -->
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" id="phone"
                                        value="{{ $dataPelanggan->phone }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- File Upload Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Upload Berkas Data Diri</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="files" class="form-label">Pilih File</label>
                                            <input type="file" class="form-control" id="files" name="files[]"
                                                   multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.zip">
                                            <div class="form-text">
                                                Dapat memilih multiple file. Format yang didukung: PDF, DOC, DOCX, JPG, JPEG, PNG, ZIP.
                                                Maksimal 10MB per file.
                                            </div>
                                        </div>

                                        <!-- List Existing Files -->
                                        @if($dataPelanggan->files->count() > 0)
                                        <div class="mt-4">
                                            <h6 class="mb-3">File yang sudah diupload:</h6>
                                            <div class="list-group">
                                                @foreach($dataPelanggan->files as $file)
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <i class="far fa-file me-2"></i>
                                                        {{ $file->original_name }}
                                                        <small class="text-muted ms-2">({{ $file->file_size }})</small>
                                                    </div>
                                                    <div>
                                                        <a href="{{ Storage::url($file->file_path) }}"
                                                           target="_blank"
                                                           class="btn btn-sm btn-outline-primary me-1">
                                                            <i class="far fa-eye"></i> Detail
                                                        </a>
                                                        <form action="{{ route('pelanggan.destroyFile', $file->id) }}"
                                                              method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                    onclick="return confirm('Hapus file ini?')">
                                                                <i class="far fa-trash-alt"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-info">
                                    <i class="far fa-save me-1"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('pelanggan.index') }}"
                                    class="btn btn-outline-secondary ms-2">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
