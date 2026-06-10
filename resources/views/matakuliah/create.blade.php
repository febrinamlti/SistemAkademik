@extends('layouts.app')

@section('content')
<div class="card animate__animated animate__pulse">
    <div class="card-header bg-white py-3">
        <h4 class="mb-0 text-custom fw-bold">Tambah Matakuliah</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('matakuliah.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Matakuliah</label>
                <input type="text" name="nama_matakuliah" class="form-control @error('nama_matakuliah') is-invalid @enderror" value="{{ old('nama_matakuliah') }}">
                @error('nama_matakuliah') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">SKS</label>
                <input type="number" name="sks" min="1" max="6" class="form-control @error('sks') is-invalid @enderror" value="{{ old('sks') }}">
                @error('sks') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
            <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary px-4 rounded-pill ms-2">Batal</a>
        </form>
    </div>
</div>
@endsection
