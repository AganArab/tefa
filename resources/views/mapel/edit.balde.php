@extends('template.master')
@section('atas', 'Edit Mata Pelajaran')
@section('judul', 'Form Edit Mata Pelajaran')

@section('conten')
<div class="col-md-8">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Mata Pelajaran</h3>
        </div>
        <form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Mata Pelajaran</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $mapel->nama) }}" placeholder="Masukkan nama mata pelajaran" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kode">Kode Mata Pelajaran</label>
                    <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror"
                        value="{{ old('kode', $mapel->kode) }}" placeholder="Masukkan kode (opsional)">
                    @error('kode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="guru_pengajar_id">Guru Pengajar</label>
                    <select name="guru_pengajar_id" class="form-control @error('guru_pengajar_id') is-invalid @enderror">
                        <option value="">-- Pilih Guru --</option>
                        @foreach($gurus as $g)
                            <option value="{{ $g->id }}" {{ old('guru_pengajar_id', $mapel->guru_pengajar_id) == $g->id ? 'selected' : '' }}>
                                {{ $g->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('guru_pengajar_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('mapel.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection