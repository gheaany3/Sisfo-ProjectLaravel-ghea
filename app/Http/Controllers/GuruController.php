<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::get();
        return view('guru.index', compact('gurus'));
    }

    public function create()
    {
       return view('guru.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'nip'           => 'required|unique:gurus,nip',
        'nama'          => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:L,P',
        'email'         => 'nullable|email|unique:gurus,email',
        'no_hp'         => 'nullable|string|max:20',
        'alamat'        => 'nullable|string',
        ]);

        Guru::create($validated);
        return redirect()->route('gurus.index')->with('success', 'Data guru berhasil ditambahkan!');
    }

    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $validated = $request->validate([
        'nip'           => 'required|unique:gurus,nip,' . $guru->id,
        'nama'          => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:L,P',
        'email'         => 'nullable|email|unique:gurus,email,' . $guru->id,
        'no_hp'         => 'nullable|string|max:20',
        'alamat'        => 'nullable|string',
        ]);

        $guru->update($validated);

        return redirect()->route('gurus.index')->with('success', 'Data guru berhasil diperbarui!');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();

        return redirect()->route('gurus.index')->with('success', 'Data guru berhasil dihapus!');
    }
}

