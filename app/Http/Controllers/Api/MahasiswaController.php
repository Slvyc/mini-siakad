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
}
