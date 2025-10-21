<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gurus = Guru::latest()->get(); // Ambil semua guru, urutkan terbaru dulu
        return view('guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:gurus,nip', // NIP wajib dan unik
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:3048' // Foto opsional, format tertentu, max 3MB
        ]);

        // Ambil hanya data nama dan nip
        $data = $request->only('nama', 'nip');

        // Jika ada file foto yang diupload
        if ($request->hasFile('foto')) {
            // Simpan file ke disk 'public' di folder 'foto/guru'
            $path = $request->file('foto')->store('foto/guru', 'public');
            // Tambahkan path file ke data yang akan disimpan
            $data['foto'] = $path;
        }

        // Buat guru baru di database
        Guru::create($data);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        // Anda bisa buat view guru.show jika diperlukan
        // return view('guru.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:gurus,nip,' . $guru->id, // NIP wajib, unik, kecuali untuk guru yang sedang diedit
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:3048', // Validasi foto
        ]);

        // Ambil hanya data nama dan nip
        $data = $request->only('nama', 'nip');

        // Jika ada file foto baru yang diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }
            // Simpan file baru
            $path = $request->file('foto')->store('foto/guru', 'public');
            // Tambahkan path file baru ke data
            $data['foto'] = $path;
        }

        // Update data guru di database
        $guru->update($data);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('guru.index')->with('success', 'Guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        // Hapus foto lama jika ada
        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }
        // Hapus data guru dari database
        $guru->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('guru.index')->with('success', 'Guru berhasil dihapus.');
    }
}