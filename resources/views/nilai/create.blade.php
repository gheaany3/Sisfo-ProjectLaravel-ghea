@extends('layouts.main')

@section('title', 'Input Nilai Siswa')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-star text-primary mr-2"></i>Input Nilai Siswa
        </h1>
    </div>

    <div class="card shadow mb-4 col-md-8 mx-auto p-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Form Input Nilai</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('nilai.store') }}" method="POST">
                @csrf

                <!-- Pilih Siswa -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Pilih Siswa</label>
                    <select name="siswa_id" class="form-control @error('siswa_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($siswas as $siswa)
                            <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                {{ $siswa->nis }} - {{ $siswa->nama }} ({{ $siswa->kelas->nama_kelas ?? '-' }})
                            </option>
                        @endforeach
                    </select>
                    @error('siswa_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Pilih Mata Pelajaran -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Mata Pelajaran</label>
                    <select name="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        @foreach ($mapels as $mapel)
                            <option value="{{ $mapel->id }}" {{ old('mapel_id') == $mapel->id ? 'selected' : '' }}>
                                {{ $mapel->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                    @error('mapel_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nilai Tugas -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Nilai Tugas (30%)</label>
                    <input type="number" name="nilai_tugas" min="0" max="100" class="form-control @error('nilai_tugas') is-invalid @enderror" value="{{ old('nilai_tugas') }}" placeholder="0 - 100" required>
                    @error('nilai_tugas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nilai UTS -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Nilai UTS (30%)</label>
                    <input type="number" name="nilai_uts" min="0" max="100" class="form-control @error('nilai_uts') is-invalid @enderror" value="{{ old('nilai_uts') }}" placeholder="0 - 100" required>
                    @error('nilai_uts')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nilai UAS -->
                <div class="form-group mb-4">
                    <label class="font-weight-bold text-gray-800">Nilai UAS (40%)</label>
                    <input type="number" name="nilai_uas" min="0" max="100" class="form-control @error('nilai_uas') is-invalid @enderror" value="{{ old('nilai_uas') }}" placeholder="0 - 100" required>
                    @error('nilai_uas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('nilai.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan Nilai
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection