<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {

        $mahasiswas = Mahasiswa::all();

        return response()->json($mahasiswas, 200);
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        return response()->json($mahasiswa, 200);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required',
            'email' => 'required|email|unique:mahasiswa,email',
            'prodi' => 'required',
            'sks' => 'required|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $mahasiswa = Mahasiswa::create($validatedData);

        return response()->json($mahasiswa, 201);
    }

    public function update(Request $request, $id)
    {

        $mahasiswa = Mahasiswa::findOrFail($id);

        $validatedData = $request->validate([
            'nim' => 'sometimes|required|unique:mahasiswa,nim',
            'nama' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:mahasiswa,email',
            'prodi' => 'sometimes|required',
            'sks' => 'sometimes|required|integer|min:0',
            'status' => 'sometimes|required|in:aktif,nonaktif'
        ]);

        $mahasiswa->update($validatedData);

        return response()->json($mahasiswa, 200);
    }

    public function destroy($id)
    {

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return response()->json(null, 204);
    }
}
