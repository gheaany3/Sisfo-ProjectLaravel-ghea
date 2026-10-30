@extends('layouts.main')

@section('title', 'Detail Data Siswa')

@section('content')
<div class="container-fluid">
    <!-- Judul Halaman & Tombol Kembali -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-graduate text-primary mr-2"></i>Detail Data Siswa
        </h1>
        <a href="{{ route('siswas.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <!-- Card Informas Profil Siswa -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">Profil Siswa</h6>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-user-circle text-gray-400 fa-6x"></i>
                    </div>
                    <h5 class="font-weight-bold text-gray-800 mb-1">{{ $siswa->nama ?? $siswa->nama_siswa }}</h5>
                    <p class="text-muted mb-3">NIS: {{ $siswa->nis }}</p>

                    <table class="table table-borderless text-left mb-0" width="100%">
                        <tr>
                            <th width="40%" class="text-gray-800 pl-0">Kelas</th>
                            <td class="pr-0">: 
                                <span class="badge badge-info px-2 py-1 font-weight-normal" style="border-radius: 10px; background-color: #36b9cc;">
                                    {{ $siswa->kelas->nama_kelas ?? $siswa->nama_kelas ?? '-' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-gray-800 pl-0">Jenis Kelamin</th>
                            <td class="pr-0">: 
                                @if (in_array($siswa->jenis_kelamin, ['L', 'Laki-Laki']))
                                    <span class="badge badge-primary px-2 py-1 font-weight-normal" style="border-radius: 10px;">Laki-Laki</span>
                                @else
                                    <span class="badge badge-danger px-2 py-1 font-weight-normal" style="border-radius: 10px; background-color: #e74a3b;">Perempuan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-gray-800 pl-0">No HP</th>
                            <td class="text-muted pr-0">: {{ $siswa->no_hp }}</td>
                        </tr>
                        <tr>
                            <th class="text-gray-800 pl-0">Alamat</th>
                            <td class="text-muted pr-0">: {{ $siswa->alamat }}</td>
                        </tr>
                    </table>

                    <hr>

                    <div class="d-flex justify-content-center">
                        <a href="{{ route('siswas.edit', $siswa->id) }}" class="btn btn-warning btn-sm text-white px-3 mr-2" style="background-color: #f6c23e; border: none;">
                            <i class="fas fa-edit mr-1"></i> Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Riwayat Nilai Mata Pelajaran -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 bg-white d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Nilai Mata Pelajaran</h6>
                    <div>
                        <a href="{{ route('siswas.nilai.create', $siswa->id) }}" class="btn btn-primary btn-sm font-weight-bold mr-1">
                            + Input Nilai
                        </a>
                        <a href="{{ route('siswas.nilai.export', $siswa->id) }}" class="btn btn-success btn-sm font-weight-bold">
                            <i class="fas fa-file-excel mr-1"></i> Export Excel
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" width="100%" cellspacing="0">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="5%" class="text-center align-middle">No</th>
                                    <th class="align-middle">Mata Pelajaran</th>
                                    <th class="text-center align-middle">KKM</th>
                                    <th class="text-center align-middle">Nilai Siswa</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th width="15%" class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswa->nilais ?? [] as $index => $nilai)
                                    <tr>
                                        <td class="text-center align-middle text-muted">{{ $index + 1 }}</td>
                                        <td class="align-middle font-weight-bold text-gray-800">
                                            {{ $nilai->mapel->nama_mapel ?? $nilai->nama_mapel ?? '-' }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge badge-warning text-white px-2 py-1" style="background-color: #f6c23e;">
                                                {{ $nilai->mapel->kkm ?? 75 }}
                                            </span>
                                        </td>
                                        <td class="text-center align-middle font-weight-bold">
                                            {{ $nilai->nilai }}
                                        </td>
                                        <td class="text-center align-middle">
                                            @if ($nilai->nilai >= ($nilai->mapel->kkm ?? 75))
                                                <span class="badge badge-success px-2 py-1">Tuntas</span>
                                            @else
                                                <span class="badge badge-danger px-2 py-1">Belum Tuntas</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <!-- Edit Nilai -->
                                            <a href="{{ route('siswas.nilai.edit', [$siswa->id, $nilai->id]) }}" class="btn btn-warning btn-sm text-white px-2 py-1 mr-1" style="background-color: #f6c23e; border: none;">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Hapus Nilai -->
                                            <form action="{{ route('siswas.nilai.destroy', [$siswa->id, $nilai->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data nilai ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm px-2 py-1" style="background-color: #e74a3b; border: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">Belum ada data nilai untuk siswa ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection