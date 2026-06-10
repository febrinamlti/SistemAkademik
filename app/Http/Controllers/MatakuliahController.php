<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Matakuliah::with('jurusan');

        if ($search) {
            $query->where('nama_matakuliah', 'like', "%{$search}%")
                  ->orWhereHas('jurusan', function ($q) use ($search) {
                      $q->where('nama_jurusan', 'like', "%{$search}%");
                  });
        }

        $matakuliahs = $query->paginate(5);
        return view('matakuliah.index', compact('matakuliahs', 'search'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('matakuliah.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_matakuliah' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan'
        ]);

        Matakuliah::create($request->all());
        return redirect()->route('matakuliah.index')->with('success', 'Data Matakuliah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $jurusans = Jurusan::all();
        return view('matakuliah.edit', compact('matakuliah', 'jurusans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_matakuliah' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan'
        ]);

        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->update($request->all());
        return redirect()->route('matakuliah.index')->with('success', 'Data Matakuliah berhasil diupdate.');
    }

    public function destroy($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->delete();
        return redirect()->route('matakuliah.index')->with('success', 'Data Matakuliah berhasil dihapus.');
    }
    public function print()
{
    $matakuliah = Matakuliah::with('jurusan')->get();

    return view('matakuliah.print', compact('matakuliah'));
}

public function exportExcel()
{
    $matakuliah = Matakuliah::with('jurusan')->get();

    return response()
        ->view('matakuliah.excel', compact('matakuliah'))
        ->header('Content-Type', 'application/vnd.ms-excel')
        ->header('Content-Disposition', 'attachment; filename=matakuliah.xls');
}
}
