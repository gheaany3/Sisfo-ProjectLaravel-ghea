@extends('layouts.main')

@section('title', 'Edit Data Kelas')

@section('content')
<div class="container-fluid">
    <!-- Judul Halaman -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-door-open text-primary mr-2"></i>Edit Data Kelas
        </h1>
    </div>

    <!-- Card Form Edit Data -->
    <div class="card shadow mb-4 col-md-8 mx-auto p-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Kelas</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('kelas.update', [$kelas->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Input Nama Kelas -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Nama Kelas</label>
                    <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
                    @error('nama_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Tingkat (Value Menggunakan Angka 10, 11, 12) -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Tingkat</label>
                    <select name="tingkat" class="form-control @error('tingkat') is-invalid @enderror" required>
                        <option value="">-- Pilih Tingkat --</option>
                        <option value="10" {{ old('tingkat', $kelas->tingkat) == '10' || old('tingkat', $kelas->tingkat) == 'X' ? 'selected' : '' }}>X</option>
                        <option value="11" {{ old('tingkat', $kelas->tingkat) == '11' || old('tingkat', $kelas->tingkat) == 'XI' ? 'selected' : '' }}>XI</option>
                        <option value="12" {{ old('tingkat', $kelas->tingkat) == '12' || old('tingkat', $kelas->tingkat) == 'XII' ? 'selected' : '' }}>XII</option>
                    </select>
                    @error('tingkat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Jurusan -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" value="{{ old('jurusan', $kelas->jurusan) }}" required>
                    @error('jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Tahun Ajaran -->
                <div class="form-group mb-4">
                    <label class="font-weight-bold text-gray-800">Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" value="{{ old('tahun_ajaran', $kelas->tahun_ajaran) }}" required>
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
                        <i class="fas fa-save mr-1"></i> Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection