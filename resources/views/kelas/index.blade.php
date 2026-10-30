@extends('layouts.main')

@section('title', 'Data Kelas')

@section('content')
<div class="container-fluid">
    <!-- Judul Halaman & Tombol Tambah Kelas -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-door-open text-primary mr-2"></i>Data Kelas
        </h1>
        <a href="{{ route('kelas.create') }}" class="btn btn-primary shadow-sm font-weight-bold">
            + Tambah Kelas
        </a>
    </div>

    <!-- Card Tabel Data Kelas -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kelas SISFO Akademik</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th width="5%" class="text-center align-middle">No</th>
                            <th class="align-middle">Nama Kelas</th>
                            <th class="text-center align-middle">Tingkat</th>
                            <th class="align-middle">Jurusan</th>
                            <th class="align-middle">Tahun Ajaran</th>
                            <th class="text-center align-middle">Jumlah Siswa</th>
                            <th width="12%" class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kelases as $index => $item)
                            <tr>
                                <td class="text-center align-middle text-muted">{{ $index + 1 }}</td>
                                <td class="align-middle font-weight-bold text-primary">{{ $item->nama_kelas }}</td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-info px-2 py-1 font-weight-normal" style="border-radius: 50px; background-color: #36b9cc;">
                                        {{ $item->tingkat_romawi }}
                                    </span>
                                </td>
                                <td class="align-middle text-muted">{{ $item->jurusan }}</td>
                                <td class="align-middle text-muted">{{ $item->tahun_ajaran }}</td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-secondary px-2 py-1 font-weight-normal" style="background-color: #6c757d;">
                                        <i class="fas fa-user-friends mr-1"></i> {{ $item->siswas_count ?? $item->jumlah_siswa ?? 0 }} Siswa
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <!-- Tombol Edit Kuning -->
                                    <a href="{{ route('kelas.edit', $item) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Tombol Hapus Merah -->
                                    <form action="{{ route('kelas.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kelas ini?')">
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
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada data kelas terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection