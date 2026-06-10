@extends('layouts.app')

@section('content')
<div class="card animate__animated animate__fadeInUp">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h4 class="mb-0 text-custom fw-bold">Data Mahasiswa</h4>
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-custom rounded-pill px-4">+ Tambah Mahasiswa</a>
    </div>
    <div class="card-body">
        
        <form method="GET" action="{{ route('mahasiswa.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control form-control-lg" placeholder="Cari nim, nama mahasiswa, atau jurusan..." value="{{ $search }}">
                <button class="btn btn-custom px-4" type="submit">Cari</button>
            </div>
        </form>

        <div class="mb-4 d-flex gap-2">
            <a href="{{ route('mahasiswa.print') }}" target="_blank" class="btn btn-danger rounded-pill px-3">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>
            <a href="{{ url('/mahasiswa/export-csv') }}" target="_blank" class="btn btn-success rounded-pill px-3">
                <i class="bi bi-file-earmark-excel"></i> Export Excel
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswas as $index => $mahasiswa)
                    <tr>
                        <td>{{ $mahasiswas->firstItem() + $index }}</td>
                        <td><span class="badge bg-secondary fs-6">{{ $mahasiswa->nim }}</span></td>
                        <td class="fw-bold">{{ $mahasiswa->nama }}</td>
                        <td>{{ $mahasiswa->jurusan->nama_jurusan ?? '-' }}</td>
                        <td>
                            <a href="{{ route('mahasiswa.edit', $mahasiswa->id_mahasiswa) }}" class="btn btn-sm btn-warning rounded-pill px-3">Edit</a>
                            <form action="{{ route('mahasiswa.destroy', $mahasiswa->id_mahasiswa) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
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
            {{ $mahasiswas->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection