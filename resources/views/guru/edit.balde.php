@extends('template.master')
@section('atas', 'Edit Guru')
@section('judul', 'Form Edit Guru')

@section('conten')
<div class="col-md-8">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Guru</h3>
        </div>
        <form action="{{ route('guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data"> <!-- Tambahkan enctype -->
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Guru</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $guru->nama) }}" placeholder="Masukkan nama guru" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                        value="{{ old('nip', $guru->nip) }}" placeholder="Masukkan NIP (opsional)">
                    @error('nip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="foto">Foto Guru</label>
                    @if($guru->foto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" width="100" class="img-thumbnail">
                        </div>
                    @endif
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="foto">
                            <label class="custom-file-label" for="foto">Pilih file baru (opsional)</label>
                        </div>
                    </div>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('guru.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
@endpush