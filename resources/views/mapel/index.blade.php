@extends('layouts.main')

@section('title', 'Data Mata Pelajaran')

@section('content')
<div class="container-fluid">
    <!-- Judul Halaman & Tombol Tambah -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-book text-primary mr-2"></i>Data Mata Pelajaran
        </h1>
        <a href="{{ route('mapels.create') }}" class="btn btn-primary shadow-sm">
            + Tambah Mapel
        </a>
    </div>

    <!-- Card & Tabel Data -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Mata Pelajaran</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th>Kode Mapel</th>
                            <th>Nama Mata Pelajaran</th>
                            <th class="text-center">KKM Minimum</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mapels as $index => $item)
                            <tr>
                                <td class="text-center align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle">
                                    <span class="badge badge-secondary px-2 py-1">{{ $item->kode_mapel }}</span>
                                </td>
                                <td class="align-middle font-weight-bold text-gray-800">{{ $item->nama_mapel }}</td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-warning px-2 py-1 text-dark">{{ $item->kkm }}</span>
                                </td>
                                <td class="text-center align-middle">
                                    <!-- Tombol Edit Kuning -->
                                    <a href="{{ route('mapels.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Tombol Hapus Merah -->
                                    <form action="{{ route('mapels.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-3 text-muted">Belum ada data mata pelajaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection