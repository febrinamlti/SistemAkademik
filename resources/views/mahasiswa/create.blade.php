@extends('layouts.app')

@section('content')
<div class="card animate__animated animate__zoomIn">
    <div class="card-header bg-white py-3">
        <h4 class="mb-0 text-custom fw-bold">Tambah Mahasiswa</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('mahasiswa.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim') }}">
                @error('nim') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Mahasiswa</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Jurusan</label>
                <select name="id_jurusan" class="form-select @error('id_jurusan') is-invalid @enderror">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusans as $jurusan)
                        <option value="{{ $jurusan->id_jurusan }}" {{ old('id_jurusan') == $jurusan->id_jurusan ? 'selected' : '' }}>
                            {{ $jurusan->nama_jurusan }}
                        </option>
                    @endforeach
                </select>
                @error('id_jurusan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-custom px-4 rounded-pill">Simpan Data</button>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary px-4 rounded-pill ms-2">Batal</a>
        </form>
    </div>
</div>
@endsection
