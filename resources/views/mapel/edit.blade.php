@extends('layouts.main')

@section('title', 'Edit Data Mata Pelajaran')

@section('content')
<div class="container-fluid">
    <!-- Judul Halaman -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-book text-primary mr-2"></i>Edit Data Mata Pelajaran
        </h1>
    </div>

    <!-- Card Form Edit Data -->
    <div class="card shadow mb-4 col-md-8 mx-auto p-0">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Mata Pelajaran</h6>
        </div>
        <div class="card-body">
            <!-- Form Update -->
            <form action="{{ route('mapels.update', $mapel->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Input Kode Mapel -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Kode Mapel</label>
                    <input type="text" name="kode_mapel" class="form-control @error('kode_mapel') is-invalid @enderror" value="{{ old('kode_mapel', $mapel->kode_mapel) }}" required>
                    @error('kode_mapel')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Nama Mapel -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-800">Nama Mata Pelajaran</label>
                    <input type="text" name="nama_mapel" class="form-control @error('nama_mapel') is-invalid @enderror" value="{{ old('nama_mapel', $mapel->nama_mapel) }}" required>
                    @error('nama_mapel')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Nilai KKM -->
                <div class="form-group mb-4">
                    <label class="font-weight-bold text-gray-800">Nilai KKM Minimum</label>
                    <input type="number" name="kkm" class="form-control @error('kkm') is-invalid @enderror" value="{{ old('kkm', $mapel->kkm) }}" required>
                    @error('kkm')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('mapels.index') }}" class="btn btn-secondary">
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