@extends('layouts.app')

@section('content')
<div class="card animate__animated animate__fadeInUp">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h4 class="mb-0 text-custom fw-bold">Data Matakuliah</h4>
        <a href="{{ route('matakuliah.create') }}" class="btn btn-custom rounded-pill px-4">+ Tambah Matakuliah</a>
    </div>
    <div class="card-body">
        
        <form method="GET" action="{{ route('matakuliah.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control form-control-lg" placeholder="Cari nama matakuliah atau jurusan..." value="{{ $search }}">
                <button class="btn btn-custom px-4" type="submit">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Matakuliah</th>
                        <th>SKS</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matakuliahs as $index => $mk)
                    <tr>
                        <td>{{ $matakuliahs->firstItem() + $index }}</td>
                        <td class="fw-bold">{{ $mk->nama_matakuliah }}</td>
                        <td><span class="badge bg-custom fs-6">{{ $mk->sks }}</span></td>
                        <td>{{ $mk->jurusan->nama_jurusan ?? '-' }}</td>
                        <td>
                            <a href="{{ route('matakuliah.edit', $mk->id_matakuliah) }}" class="btn btn-sm btn-warning rounded-pill px-3">Edit</a>
                            <form action="{{ route('matakuliah.destroy', $mk->id_matakuliah) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $matakuliahs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
