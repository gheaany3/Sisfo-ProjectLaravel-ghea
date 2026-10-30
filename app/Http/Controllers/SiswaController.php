<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('kelas')->get();
        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        $kelases = Kelas::all();
        return view('siswa.create', compact('kelases'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis'           => 'required|string|max:255|unique:siswas,nis',
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P', // L dan P sesuai dropdown
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:20',
            'kelas_id'      => 'required|exists:kelas,id',
        ]);

        Siswa::create($validated);

        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        $kelases = Kelas::all();
        return view('siswa.edit', compact('siswa', 'kelases'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nis'           => 'required|string|max:255|unique:siswas,nis,' . $siswa->id,
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:20',
            'kelas_id'      => 'required|exists:kelas,id',
        ]);

        $siswa->update($validated);

        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}

