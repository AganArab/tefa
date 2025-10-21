<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Ruangan;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    protected $hariValid = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    public function index($hari)
    {
        if (!in_array($hari, $this->hariValid)) {
            abort(404);
        }

        $jadwals = Jadwal::where('hari', $hari)
            ->with(['guru', 'mapel', 'mapel.guruPengajar', 'ruangan', 'ruangan.penanggungJawab']) // Load relasi
            ->orderBy('waktu_mulai')
            ->get();

        return view('jadwal.index', compact('jadwals', 'hari'));
    }

    public function create($hari)
    {
        if (!in_array($hari, $this->hariValid)) {
            abort(404);
        }

        $gurus = Guru::all();
        $mapels = Mapel::with('guruPengajar')->get(); // Load guru pengajar
        $ruangans = Ruangan::with('penanggungJawab')->get(); // Load penanggung jawab

        return view('jadwal.create', compact('hari', 'gurus', 'mapels', 'ruangans'));
    }

    public function store(Request $request, $hari)
    {
        if (!in_array($hari, $this->hariValid)) {
            abort(404);
        }

        $request->validate([
            'jam_ke' => 'required|string|max:255',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'ruangan_id' => 'required|exists:ruangans,id',
            'status' => 'required|in:Aktif,Istirahat',
        ]);

        $data = [
            'hari' => $hari,
            'jam_ke' => $request->jam_ke,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'ruangan_id' => $request->ruangan_id,
            'status' => $request->status,
            'guru_id' => null,
            'mapel_id' => null,
        ];

        if ($request->status === 'Aktif') {
            $request->validate([
                'guru_id' => 'required|exists:gurus,id',
                'mapel_id' => 'required|exists:mapels,id',
            ]);
            $data['guru_id'] = $request->guru_id;
            $data['mapel_id'] = $request->mapel_id;
        }

        Jadwal::create($data);

        return redirect()->route('jadwal.hari', $hari)->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($hari, Jadwal $jadwal)
    {
        if (!in_array($hari, $this->hariValid) || $jadwal->hari !== $hari) {
            abort(404);
        }

        $gurus = Guru::all();
        $mapels = Mapel::with('guruPengajar')->get();
        $ruangans = Ruangan::with('penanggungJawab')->get();

        return view('jadwal.edit', compact('hari', 'jadwal', 'gurus', 'mapels', 'ruangans'));
    }

    public function update(Request $request, $hari, Jadwal $jadwal)
    {
        if (!in_array($hari, $this->hariValid) || $jadwal->hari !== $hari) {
            abort(404);
        }

        $request->validate([
            'jam_ke' => 'required|string|max:255',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'ruangan_id' => 'required|exists:ruangans,id',
            'status' => 'required|in:Aktif,Istirahat',
        ]);

        $data = [
            'jam_ke' => $request->jam_ke,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'ruangan_id' => $request->ruangan_id,
            'status' => $request->status,
            'guru_id' => null,
            'mapel_id' => null,
        ];

        if ($request->status === 'Aktif') {
            $request->validate([
                'guru_id' => 'required|exists:gurus,id',
                'mapel_id' => 'required|exists:mapels,id',
            ]);
            $data['guru_id'] = $request->guru_id;
            $data['mapel_id'] = $request->mapel_id;
        }

        $jadwal->update($data);

        return redirect()->route('jadwal.hari', $hari)->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($hari, Jadwal $jadwal)
    {
        if (!in_array($hari, $this->hariValid) || $jadwal->hari !== $hari) {
            abort(404);
        }

        $jadwal->delete();

        return redirect()->route('jadwal.hari', $hari)->with('success', 'Jadwal berhasil dihapus.');
    }
}