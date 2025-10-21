@extends('template.master')
@section('atas', "Jadwal Pelajaran - $hari")
@section('judul', "Jadwal Hari $hari")

@section('conten')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Jadwal Hari {{ $hari }}</h3>
            <div>
                <a href="{{ route('jadwal.create', ['hari' => $hari]) }}" class="btn btn-primary btn-sm">+ Tambah Jadwal</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Jam Ke</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru (Jadwal)</th> <!-- Guru yang mengajar di jadwal ini -->
                            <th>Guru (Mapel)</th> <!-- Guru pengajar tetap dari mapel -->
                            <th>Ruangan</th>
                            <th>Penanggung Jawab (Ruangan)</th> <!-- Penanggung jawab tetap dari ruangan -->
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwals as $jadwal)
                        <tr>
                            <td>{{ $jadwal->jam_ke }}</td>
                            <td>{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</td>
                            <td>
                                <span class="badge badge-{{ $jadwal->status === 'Aktif' ? 'success' : 'warning' }}">
                                    {{ $jadwal->status }}
                                </span>
                            </td>
                            <td>{{ $jadwal->mapel->nama ?? 'N/A' }}</td>
                            <td>{{ $jadwal->guru?->nama ?? 'N/A' }}</td> <!-- Guru dari jadwal -->
                            <td>{{ $jadwal->mapel?->guruPengajar?->nama ?? 'N/A' }}</td> <!-- Guru dari mapel -->
                            <td>{{ $jadwal->ruangan->nama ?? 'N/A' }}</td>
                            <td>{{ $jadwal->ruangan?->penanggungJawab?->nama ?? 'N/A' }}</td> <!-- Penanggung jawab dari ruangan -->
                            <td>
                                <a href="{{ route('jadwal.edit', ['hari' => $hari, 'jadwal' => $jadwal->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('jadwal.destroy', ['hari' => $hari, 'jadwal' => $jadwal->id]) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus jadwal ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada jadwal untuk hari ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection