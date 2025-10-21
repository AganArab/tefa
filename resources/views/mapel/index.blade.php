@extends('template.master')
@section('atas', 'Data Mata Pelajaran')
@section('judul', 'Daftar Mata Pelajaran')

@section('conten')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Mata Pelajaran</h3>
            <div class="card-tools">
                <a href="{{ route('mapel.create') }}" class="btn btn-primary btn-sm">Tambah Mapel</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th>Guru Pengajar</th> <!-- Kolom baru -->
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mapels as $i => $mapel)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $mapel->nama }}</td>
                        <td>{{ $mapel->kode ?? '–' }}</td>
                        <td>{{ $mapel->guruPengajar?->nama ?? 'Belum Ditentukan' }}</td> <!-- Gunakan relasi -->
                        <td>
                            <a href="{{ route('mapel.edit', $mapel->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('mapel.destroy', $mapel->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus mata pelajaran ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Belum ada data mata pelajaran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection