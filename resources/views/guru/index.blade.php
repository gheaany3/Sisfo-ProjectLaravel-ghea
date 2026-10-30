@extends('layouts.main')

@section('title', 'Data Guru')

@section('content')
<div class="container-fluid">
    <!-- Judul Halaman & Tombol Tambah Guru -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-chalkboard-teacher text-primary mr-2"></i>Data Guru
        </h1>
        <a href="{{ route('gurus.create') }}" class="btn btn-primary shadow-sm font-weight-bold">
            + Tambah Guru
        </a>
    </div>

    <!-- Card Tabel Data Guru -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Guru / Tenaga Pendidik</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th width="5%" class="text-center align-middle">No</th>
                            <th class="align-middle">NIP</th>
                            <th class="align-middle">Nama Guru</th>
                            <th class="text-center align-middle">Gender</th>
                            <th class="align-middle">Email</th>
                            <th class="align-middle">No HP</th>
                            <th width="12%" class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gurus as $index => $item)
                            <tr>
                                <td class="text-center align-middle text-muted">{{ $index + 1 }}</td>
                                <td class="align-middle">
                                    <span class="badge badge-secondary px-2 py-1 font-weight-normal" style="background-color: #6c757d; font-size: 11px; letter-spacing: 0.5px;">
                                        {{ $item->nip }}
                                    </span>
                                </td>
                                <td class="align-middle font-weight-bold text-gray-800">{{ $item->nama }}</td>
                                <td class="text-center align-middle">
                                    @if (in_array($item->jenis_kelamin, ['L', 'Laki-Laki']))
                                        <span class="badge badge-primary px-3 py-1 font-weight-normal" style="border-radius: 10px;">Laki-Laki</span>
                                    @else
                                        <span class="badge badge-danger px-3 py-1 font-weight-normal" style="border-radius: 10px; background-color: #e74a3b;">Perempuan</span>
                                    @endif
                                </td>
                                <td class="align-middle text-muted">{{ $item->email }}</td>
                                <td class="align-middle text-muted">{{ $item->no_hp }}</td>
                                <td class="text-center align-middle">
                                    <!-- Tombol Edit Kuning/Oranye -->
                                    <a href="{{ route('gurus.edit', $item->id) }}" class="btn btn-warning btn-sm text-white px-2 py-1 mr-1" style="background-color: #f6c23e; border: none;">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Tombol Hapus Merah -->
                                    <form action="{{ route('gurus.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru ini?')">
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
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada data guru terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection