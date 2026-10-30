<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelases = Kelas::withCount('siswas')->get();
        return view('kelas.index', compact('kelases'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tingkat' => 'required|in:10,11,12',
            'jurusan' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:255'
        ]);

        Kelas::create($validated);
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan!');
    }

    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tingkat' => 'required|in:10,11,12',
            'jurusan' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:255'
        ]);

        $kelas->update($validated);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        // Cek apakah kelas ini masih memiliki siswa
        if ($kelas->siswas()->count() > 0) {
            return redirect()->route('kelas.index')->with('error', 'Kelas tidak bisa dihapus karena masih memiliki siswa!');
        }

        // Jika tidak ada siswa, baru hapus kelasnya
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus!');
    }
}

