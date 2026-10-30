@extends('layouts.main')

@section('title', 'Tambah Data Kelas')

@section('content')
<div class="container-fluid">
    <!-- Judul Halaman -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-door-open text-primary mr-2"></i>Tambah Data Kelas
        </h1>
    </div>

    <!-- Card Form Tambah Data -->
    <div class="card shadow mb-4 col-md-8 mx-auto p-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Kelas</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf

                <!-- Input Nama Kelas -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Nama Kelas</label>
                    <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" value="{{ old('nama_kelas') }}" placeholder="Contoh: XI RPL 1" required>
                    @error('nama_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Tingkat -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Tingkat</label>
                    <select name="tingkat" class="form-control @error('tingkat') is-invalid @enderror" required>
                        <option value="">-- Pilih Tingkat --</option>
                        <option value="10" {{ old('tingkat') == '10' ? 'selected' : '' }}>X</option>
                        <option value="11" {{ old('tingkat') == '11' ? 'selected' : '' }}>XI</option>
                        <option value="12" {{ old('tingkat') == '12' ? 'selected' : '' }}>XII</option>
                    </select>
                    @error('tingkat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Jurusan -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" value="{{ old('jurusan') }}" placeholder="Contoh: Rekayasa Perangkat Lunak" required>
                    @error('jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Tahun Ajaran -->
                <div class="form-group mb-4">
                    <label class="font-weight-bold text-gray-800">Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" value="{{ old('tahun_ajaran') }}" placeholder="Contoh: 2025/2026" required>
                    @error('tahun_ajaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection