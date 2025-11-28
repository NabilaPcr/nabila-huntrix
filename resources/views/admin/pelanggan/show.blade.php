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
                <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Pelanggan</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Detail Pelanggan</h1>
                <p class="mb-0">Informasi lengkap data pelanggan.</p>
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
                    <div class="row mb-4">
                        <div class="col-lg-6 col-md-6">
                            <!-- Personal Information -->
                            <h5 class="mb-3">Informasi Pribadi</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nama Depan</label>
                                        <p class="form-control-plaintext border-bottom pb-2">{{ $pelanggan->first_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nama Belakang</label>
                                        <p class="form-control-plaintext border-bottom pb-2">{{ $pelanggan->last_name }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Tanggal Lahir</label>
                                        <p class="form-control-plaintext border-bottom pb-2">
                                            {{ $pelanggan->birthday ? \Carbon\Carbon::parse($pelanggan->birthday)->format('d F Y') : '-' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Jenis Kelamin</label>
                                        <p class="form-control-plaintext border-bottom pb-2">
                                            @if($pelanggan->gender == 'Male')
                                                <span class="badge bg-primary">Laki-laki</span>
                                            @elseif($pelanggan->gender == 'Female')
                                                <span class="badge bg-pink">Perempuan</span>
                                            @else
                                                <span class="badge bg-secondary">Lainnya</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <!-- Contact Information -->
                            <h5 class="mb-3">Informasi Kontak</h5>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <p class="form-control-plaintext border-bottom pb-2">
                                    <a href="mailto:{{ $pelanggan->email }}" class="text-decoration-none">
                                        {{ $pelanggan->email }}
                                    </a>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Telepon</label>
                                <p class="form-control-plaintext border-bottom pb-2">
                                    {{ $pelanggan->phone ?: '-' }}
                                </p>
                            </div>

                            <!-- Additional Info -->
                            <h5 class="mb-3 mt-4">Informasi Tambahan</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">ID Pelanggan</label>
                                        <p class="form-control-plaintext border-bottom pb-2">#{{ $pelanggan->pelanggan_id }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Tanggal Dibuat</label>
                                        <p class="form-control-plaintext border-bottom pb-2">
                                            {{ $pelanggan->created_at ? $pelanggan->created_at->format('d F Y H:i') : '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Files Section -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Berkas Data Diri</h6>
                                </div>
                                <div class="card-body">
                                    @if($pelanggan->files->count() > 0)
                                        <div class="list-group">
                                            @foreach($pelanggan->files as $file)
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="far fa-file me-2"></i>
                                                    {{ $file->original_name }}
                                                    <small class="text-muted ms-2">({{ $file->file_size }})</small>
                                                </div>
                                                <a href="{{ Storage::url($file->file_path) }}"
                                                   target="_blank"
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="far fa-eye"></i> Lihat File
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted mb-0">Belum ada file yang diupload.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <a href="{{ route('pelanggan.edit', $pelanggan->pelanggan_id) }}" class="btn btn-info">
                                <svg class="icon icon-xs me-2" data-slot="icon" fill="none"
                                    stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10">
                                    </path>
                                </svg>
                                Edit Pelanggan
                            </a>

                            <form action="{{ route('pelanggan.destroy', $pelanggan->pelanggan_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
                                    <svg class="icon icon-xs me-2" data-slot="icon"
                                        fill="none" stroke-width="1.5" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                        </path>
                                    </svg>
                                    Hapus Pelanggan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end main content  --}}
@endsection
