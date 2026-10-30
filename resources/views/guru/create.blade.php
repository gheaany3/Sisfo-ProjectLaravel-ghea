@extends('layouts.main')

@section('title', 'Tambah Data Guru')

@section('content')
<div class="container-fluid">
    <!-- Judul Halaman -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-chalkboard-teacher text-primary mr-2"></i>Tambah Data Guru
        </h1>
    </div>

    <!-- Card Form Tambah Data -->
    <div class="card shadow mb-4 col-md-8 mx-auto p-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Guru</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('gurus.store') }}" method="POST">
                @csrf

                <!-- Input NIP -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">NIP</label>
                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" placeholder="Contoh: 198501152010011001" required>
                    @error('nip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Nama Lengkap (menggunakan name="nama" sesuai kolom database) -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Contoh: Drs. Ahmad Dahlan, M.Pd" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Jenis Kelamin -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Email -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Contoh: ahmad.dahlan@sekolah.sch.id" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input No HP -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">No HP</label>
                    <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" placeholder="Contoh: 081399887766" required>
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Alamat -->
                <div class="form-group mb-4">
                    <label class="font-weight-bold text-gray-800">Alamat</label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" placeholder="Masukkan alamat lengkap guru" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('gurus.index') }}" class="btn btn-secondary">
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