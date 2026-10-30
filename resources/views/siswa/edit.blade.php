@extends('layouts.main')

@section('title', 'Edit Data Siswa')

@section('content')
<div class="container-fluid">
    <!-- Judul Halaman -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-graduate text-primary mr-2"></i>Edit Data Siswa
        </h1>
    </div>

    <!-- Card Form Edit Data -->
    <div class="card shadow mb-4 col-md-8 mx-auto p-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Siswa</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('siswas.update', $siswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Input NIS -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">NIS</label>
                    <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror" value="{{ old('nis', $siswa->nis) }}" required>
                    @error('nis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Nama Lengkap -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $siswa->nama ?? $siswa->nama_siswa) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Kelas (Select Dropdown Relasi) -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Kelas</label>
                    <select name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelases as $kelas)
                            <option value="{{ $kelas->id }}" {{ old('kelas_id', $siswa->kelas_id) == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas_id')
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

                <!-- Input No HP -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">No HP</label>
                    <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $siswa->no_hp) }}" required>
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Alamat -->
                <div class="form-group mb-4">
                    <label class="font-weight-bold text-gray-800">Alamat</label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('siswas.index') }}" class="btn btn-secondary">
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