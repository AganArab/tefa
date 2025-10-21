<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    // Halaman utama: selalu ruangan ID 1
    public function index()
    {
        $ruanganId = 2;
        $ruangan = Ruangan::with('penanggungJawab')->findOrFail($ruanganId);
        $jadwals = Jadwal::with(['guru', 'mapel'])
            ->where('ruangan_id', $ruangan->id)
            ->get();

        return view('display.index', compact('ruangan', 'jadwals'));
    }

    // Halaman hari: selalu ruangan ID 1
    public function showDay($hari)
    {
        $ruanganId = 2;
        $hari = ucfirst(strtolower($hari));
        if (!in_array($hari, ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'])) {
            abort(404);
        }

        $ruangan = Ruangan::findOrFail($ruanganId);
        $jadwals = Jadwal::with(['guru', 'mapel'])
            ->where('ruangan_id', $ruangan->id)
            ->where('hari', $hari)
            ->orderBy('waktu_mulai')
            ->get();

        return view('display.hari', compact('ruangan', 'jadwals', 'hari'));
    }
}