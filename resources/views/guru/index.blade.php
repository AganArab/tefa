@extends('template.master')
@section('atas', 'Data Guru')
@section('judul', 'Daftar Guru')

@section('conten')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Guru</h3>
            <div class="card-tools">
                <a href="{{ route('guru.create') }}" class="btn btn-primary btn-sm">Tambah Guru</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th> <!-- Kolom baru -->
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gurus as $i => $guru)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>
                            @if($guru->foto)
                                <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto {{ $guru->nama }}" width="50" class="img-circle elevation-2">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $guru->nama }}</td>
                        <td>{{ $guru->nip ?? '–' }}</td>
                        <td>
                            <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus guru ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Belum ada data guru.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection