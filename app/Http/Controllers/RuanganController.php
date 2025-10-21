<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Guru; // Import Guru
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::with('penanggungJawab')->get(); // Load penanggung jawab
        return view('ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        $gurus = Guru::all(); // Ambil semua guru
        return view('ruangan.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'nullable|string|max:255|unique:ruangans,kode',
            'kapasitas' => 'nullable|integer|min:0',
            'penanggung_jawab_id' => 'nullable|exists:gurus,id', // Validasi penanggung jawab
        ]);

        Ruangan::create($request->all());

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function show(Ruangan $ruangan)
    {
        $ruangan->load('penanggungJawab'); // Load penanggung jawab
        return view('ruangan.show', compact('ruangan'));
    }

    public function edit(Ruangan $ruangan)
    {
        $gurus = Guru::all();
        return view('ruangan.edit', compact('ruangan', 'gurus'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'nullable|string|max:255|unique:ruangans,kode,' . $ruangan->id,
            'kapasitas' => 'nullable|integer|min:0',
            'penanggung_jawab_id' => 'nullable|exists:gurus,id',
        ]);

        $ruangan->update($request->all());

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}