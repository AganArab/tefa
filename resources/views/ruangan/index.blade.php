@extends('template.master')
@section('atas', 'Data Ruangan')
@section('judul', 'Daftar Ruangan')

@section('conten')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Ruangan</h3>
            <div class="card-tools">
                <a href="{{ route('ruangan.create') }}" class="btn btn-primary btn-sm">Tambah Ruangan</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th>Kapasitas</th>
                        <th>Penanggung Jawab</th> <!-- Kolom baru -->
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ruangans as $i => $ruangan)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $ruangan->nama }}</td>
                        <td>{{ $ruangan->kode ?? '–' }}</td>
                        <td>{{ $ruangan->kapasitas ?? '–' }}</td>
                        <td>{{ $ruangan->penanggungJawab?->nama ?? 'Belum Ditentukan' }}</td> <!-- Gunakan relasi -->
                        <td>
                            <a href="{{ route('ruangan.edit', $ruangan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus ruangan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center">Belum ada data ruangan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection