@extends('layouts.app')

@section('content')
<div class="card animate__animated animate__fadeInLeft">
    <div class="card-header bg-white py-3">
        <h4 class="mb-0 text-custom fw-bold">Tambah Jurusan</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('jurusan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" class="form-control @error('nama_jurusan') is-invalid @enderror" value="{{ old('nama_jurusan') }}">
                @error('nama_jurusan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Akreditasi</label>
                <select name="akreditasi" class="form-select @error('akreditasi') is-invalid @enderror">
                    <option value="">-- Pilih Akreditasi --</option>
                    <option value="A" {{ old('akreditasi') == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('akreditasi') == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ old('akreditasi') == 'C' ? 'selected' : '' }}>C</option>
                    <option value="Unggul" {{ old('akreditasi') == 'Unggul' ? 'selected' : '' }}>Unggul</option>
                </select>
                @error('akreditasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-custom px-4 rounded-pill">Simpan Data</button>
            <a href="{{ route('jurusan.index') }}" class="btn btn-secondary px-4 rounded-pill ms-2">Batal</a>
        </form>
    </div>
</div>
@endsection
