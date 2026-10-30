@extends('layouts.main')

@section('title', 'Data Siswa')

@section('content')
<div class="container-fluid">
    <!-- Judul Halaman & Tombol Tambah Siswa -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-graduate text-primary mr-2"></i>Data Siswa
        </h1>
        <a href="{{ route('siswas.create') }}" class="btn btn-primary shadow-sm font-weight-bold">
            + Tambah Siswa
        </a>
    </div>

    <!-- Card Tabel Data Siswa -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa Terdaftar</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th width="5%" class="text-center align-middle">No</th>
                            <th class="align-middle">NIS</th>
                            <th class="align-middle">Nama Siswa</th>
                            <th class="text-center align-middle">Jenis Kelamin</th>
                            <th class="text-center align-middle">Kelas</th>
                            <th class="align-middle">No HP</th>
                            <th width="14%" class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswas as $index => $item)
                            <tr>
                                <td class="text-center align-middle text-muted">{{ $index + 1 }}</td>
                                <td class="align-middle">
                                    <span class="badge badge-secondary px-2 py-1 font-weight-normal" style="background-color: #6c757d; font-size: 11px; letter-spacing: 0.5px;">
                                        {{ $item->nis }}
                                    </span>
                                </td>
                                <td class="align-middle font-weight-bold text-gray-800">{{ $item->nama ?? $item->nama_siswa }}</td>
                                <td class="text-center align-middle">
                                    @if (in_array($item->jenis_kelamin, ['L', 'Laki-Laki']))
                                        <span class="badge badge-primary px-3 py-1 font-weight-normal" style="border-radius: 10px;">Laki-Laki</span>
                                    @else
                                        <span class="badge badge-danger px-3 py-1 font-weight-normal" style="border-radius: 10px; background-color: #e74a3b;">Perempuan</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-info px-2 py-1 font-weight-normal" style="border-radius: 10px; background-color: #36b9cc;">
                                        {{ $item->kelas->nama_kelas ?? $item->nama_kelas ?? '-' }}
                                    </span>
                                </td>
                                <td class="align-middle text-muted">{{ $item->no_hp }}</td>
                                <td class="text-center align-middle">
                                    <!-- Tombol Detail Biru Muda -->
                                    <a href="{{ route('siswas.show', $item->id) }}" class="btn btn-info btn-sm text-white px-2 py-1 mr-1" style="background-color: #36b9cc; border: none;">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Tombol Edit Kuning -->
                                    <a href="{{ route('siswas.edit', $item->id) }}" class="btn btn-warning btn-sm text-white px-2 py-1 mr-1" style="background-color: #f6c23e; border: none;">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Tombol Hapus Merah -->
                                    <form action="{{ route('siswas.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')">
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
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada data siswa terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection