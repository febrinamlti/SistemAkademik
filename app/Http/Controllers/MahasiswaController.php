<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Mahasiswa::with('jurusan');

        if ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhereHas('jurusan', function ($q) use ($search) {
                      $q->where('nama_jurusan', 'like', "%{$search}%");
                  });
        }

        $mahasiswas = $query->paginate(5);
        return view('mahasiswa.index', compact('mahasiswas', 'search'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('mahasiswa.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:50|unique:mahasiswa,nim',
            'nama' => 'required|string|max:255',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan'
        ]);

        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $jurusans = Jurusan::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'jurusans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|string|max:50|unique:mahasiswa,nim,'.$id.',id_mahasiswa',
            'nama' => 'required|string|max:255',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan'
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diupdate.');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus.');
    }
    // PRINT CSV
public function exportCsv()
{
    $fileName = 'mahasiswa.csv';

    $headers = [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
    ];

    $callback = function () {

        $file = fopen('php://output', 'w');

        // Tambahkan BOM agar karakter UTF-8 terbaca baik di Excel
        fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

        // Header kolom
        fputcsv($file, [
            'ID',
            'NIM',
            'Nama',
            'Jurusan'
        ], ';');

        $mahasiswa = Mahasiswa::with('detail_jurusan')->get();

        foreach ($mahasiswa as $item) {

            fputcsv($file, [
                $item->id,
                $item->nim,
                $item->nama,
                $item->detail_jurusan->nama_jurusan ?? '-',
            ], ';'); // delimiter titik koma
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
// PRINT PDF
public function print()
{
    $mahasiswa = Mahasiswa::with('detail_jurusan')->get();

    return view('mahasiswa.print', compact('mahasiswa'));
}

// PRINT EXCEL
public function exportExcel()
{
    $mahasiswa = Mahasiswa::with('detail_jurusan')->get();

    return response()
        ->view('mahasiswa.excel', compact('mahasiswa'))
        ->header('Content-Type', 'application/vnd.ms-excel')
        ->header('Content-Disposition', 'attachment; filename=mahasiswa.xls');
}
}