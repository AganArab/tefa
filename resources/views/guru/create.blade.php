@extends('template.master')
@section('atas', 'Tambah Guru')
@section('judul', 'Form Tambah Guru')

@section('conten')
<div class="col-md-8">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Guru</h3>
        </div>
        <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data"> <!-- Tambahkan enctype -->
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Guru</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama') }}" placeholder="Masukkan nama guru" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                        value="{{ old('nip') }}" placeholder="Masukkan NIP (opsional)">
                    @error('nip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="foto">Foto Guru</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="foto">
                            <label class="custom-file-label" for="foto">Pilih file</label>
                        </div>
                    </div>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('guru.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
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