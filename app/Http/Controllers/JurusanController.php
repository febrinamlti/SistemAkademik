<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Jurusan::query();

        if ($search) {
            $query->where('nama_jurusan', 'like', "%{$search}%")
                  ->orWhere('akreditasi', 'like', "%{$search}%");
        }

        $jurusans = $query->paginate(5);
        return view('jurusan.index', compact('jurusans', 'search'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
            'akreditasi' => 'required|string|max:10'
        ]);

        Jurusan::create($request->all());
        return redirect()->route('jurusan.index')->with('success', 'Data Jurusan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
            'akreditasi' => 'required|string|max:10'
        ]);

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update($request->all());
        return redirect()->route('jurusan.index')->with('success', 'Data Jurusan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();
        return redirect()->route('jurusan.index')->with('success', 'Data Jurusan berhasil dihapus.');
    }
    // PRINT PDF
public function print()
{
    $jurusan = Jurusan::all();

    return view('jurusan.print', compact('jurusan'));
}

// PRINT EXCEL
public function exportExcel()
{
    $jurusan = Jurusan::all();

    return response()
        ->view('jurusan.excel', compact('jurusan'))
        ->header('Content-Type', 'application/vnd.ms-excel')
        ->header('Content-Disposition', 'attachment; filename=jurusan.xls');
}
}
