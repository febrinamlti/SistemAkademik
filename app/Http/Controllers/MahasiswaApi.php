<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaApi extends Controller
{

//menampilkan data mahasiswa di mahasiswa api
    public function index()
    {
        $mahasiswa = Mahasiswa::with('jurusan')->get();

        if ($mahasiswa->isEmpty()) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data mahasiswa berhasil ditemukan',
            'result' => $mahasiswa
        ], 200);
    }

    //mengambil data mahasiswa berdasarkan id jurusan di mahasiswa api  
    public function show($id_jurusan)
    {
        $mahasiswa = Mahasiswa::with('jurusan')->find($id_jurusan);

        if (!$mahasiswa) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Detail data mahasiswa',
            'result' => $mahasiswa
        ], 200);
    }

    //menambahkan data mahasiswa di mahasiswa api
    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::create($request->all());

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data mahasiswa berhasil ditemukan',
            'result' => $mahasiswa
        ], 200);
    }

    //merubah data mahasiswa berdasarkan id jurusan di mahasiswa api
    public function update(Request $request, $id)
{
    $mahasiswa = Mahasiswa::find($id);

    if (!$mahasiswa) {
        return response()->json([
            'success' => false,
            'message' => 'Data mahasiswa tidak ditemukan'
        ], 404);
    }

    $mahasiswa->update($request->all());

    return response()->json([
        'status' => 200,
        'success' => true,
        'message' => 'Data mahasiswa berhasil diupdate',
        'result' => $mahasiswa
    ], 200);
}

//menghapus data mahasiswa berdasarkan id jurusan di mahasiswa api
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan'
            ], 404);
        }

        $mahasiswa->delete();

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data mahasiswa berhasil dihapus'
        ], 200);
    }
}