@extends('layouts.app')

@section('content')
<div class="card animate__animated animate__fadeInUp">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h4 class="mb-0 text-custom fw-bold">Data Jurusan</h4>
        <a href="{{ route('jurusan.create') }}" class="btn btn-custom rounded-pill px-4">+ Tambah Jurusan</a>
    </div>
    <div class="card-body">
        
        <form method="GET" action="{{ route('jurusan.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control form-control-lg" placeholder="Cari jurusan atau akreditasi..." value="{{ $search }}">
                <button class="btn btn-custom px-4" type="submit">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Jurusan</th>
                        <th>Akreditasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jurusans as $index => $jurusan)
                    <tr>
                        <td>{{ $jurusans->firstItem() + $index }}</td>
                        <td class="fw-bold">{{ $jurusan->nama_jurusan }}</td>
                        <td><span class="badge bg-custom fs-6">{{ $jurusan->akreditasi }}</span></td>
                        <td>
                            <a href="{{ route('jurusan.edit', $jurusan->id_jurusan) }}" class="btn btn-sm btn-warning rounded-pill px-3">Edit</a>
                            <form action="{{ route('jurusan.destroy', $jurusan->id_jurusan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $jurusans->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
