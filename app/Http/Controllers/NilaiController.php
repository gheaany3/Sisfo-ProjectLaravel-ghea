<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilais = Nilai::with(['siswa.kelas', 'mapel'])->get();
        return view('nilai.index', compact('nilais'));
    }

    public function create()
    {
        $siswas = Siswa::all();
        $mapels = Mapel::all();
        return view('nilai.create', compact('siswas', 'mapels'));
    }

    public function store(Request $request)
    {
        // Validasi Input Form
        $request->validate([
            'siswa_id'    => 'required',
            'mapel_id'    => 'required',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts'   => 'required|numeric|min:0|max:100',
            'nilai_uas'   => 'required|numeric|min:0|max:100',
        ]);

        // Rumus Hitung Nilai Akhir: (30% Tugas + 30% UTS + 40% UAS)
        $nilaiAkhir = ($request->nilai_tugas * 0.3) + ($request->nilai_uts * 0.3) + ($request->nilai_uas * 0.4);
        $keterangan = $nilaiAkhir >= 75 ? 'Lulus' : 'Tidak Lulus';

        try {
        // Simpan Data Nilai
            Nilai::create([
                'siswa_id'    => $request->siswa_id,
                'mapel_id'    => $request->mapel_id,
                'nilai_tugas' => $request->nilai_tugas,
                'nilai_uts'   => $request->nilai_uts,
                'nilai_uas'   => $request->nilai_uas,
                'nilai_akhir' => $nilaiAkhir,
                'keterangan'  => $keterangan,
            ]);

            // Redirect ke 'nilai.index' (sesuai route tunggal tanpa s)
            return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil ditambahkan!');

        } catch (\Illuminate\Database\QueryException $e) {
            // Mencegah error crash jika kombinasi siswa & mapel duplikat
            return redirect()->back()->withInput()->with('error', 'Siswa ini sudah memiliki nilai pada mata pelajaran tersebut!');
        }
    }

    public function edit(Nilai $nilai)
    {
        $siswas = Siswa::all();
        $mapels = Mapel::all();
        return view('nilai.edit', compact('nilai', 'siswas', 'mapels'));
    }

    public function update(Request $request, Nilai $nilai)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'nilai_tugas' => 'required|integer|min:0|max:100',
            'nilai_uts' => 'required|integer|min:0|max:100',
            'nilai_uas' => 'required|integer|min:0|max:100'
        ]);

        // Hitung ulang nilai akhir & keterangan
        $nilai_akhir = ($validated['nilai_tugas'] * 0.3) + ($validated['nilai_uts'] * 0.3) + ($validated['nilai_uas'] * 0.4);
        $kkm = Mapel::find($validated['mapel_id'])->kkm;
        $keterangan = $nilai_akhir >= $kkm ? 'Lulus' : 'Tidak Lulus';

        // Perbarui data nilai
        $nilai->update(array_merge($validated, ['nilai_akhir' => $nilai_akhir, 'keterangan' => $keterangan]));
        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil diperbarui!');
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil dihapus!');
    }
}

