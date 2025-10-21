<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Guru; // Import Guru
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::with('guruPengajar')->get(); // Load guru pengajar
        return view('mapel.index', compact('mapels'));
    }

    public function create()
    {
        $gurus = Guru::all(); // Ambil semua guru
        return view('mapel.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'nullable|string|max:255|unique:mapels,kode',
            'guru_pengajar_id' => 'nullable|exists:gurus,id', // Validasi guru pengajar
        ]);

        Mapel::create($request->all());

        return redirect()->route('mapel.index')->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }

    public function show(Mapel $mapel)
    {
        $mapel->load('guruPengajar'); // Load guru pengajar
        return view('mapel.show', compact('mapel'));
    }

    public function edit(Mapel $mapel)
    {
        $gurus = Guru::all();
        return view('mapel.edit', compact('mapel', 'gurus'));
    }

    public function update(Request $request, Mapel $mapel)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'nullable|string|max:255|unique:mapels,kode,' . $mapel->id,
            'guru_pengajar_id' => 'nullable|exists:gurus,id',
        ]);

        $mapel->update($request->all());

        return redirect()->route('mapel.index')->with('success', 'Mata Pelajaran berhasil diperbarui.');
    }

    public function destroy(Mapel $mapel)
    {
        $mapel->delete();

        return redirect()->route('mapel.index')->with('success', 'Mata Pelajaran berhasil dihapus.');
    }
}