<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class KknController extends Controller
{
    public function validasiSyarat(Request $request)
    {
        // ambil yang sedang login berdasarkan token
        $user = $request->user();

        // Ambil data akademik dari relasi 'mahasiswa'
        $mahasiswa = $user->mahasiswa;
        if (!$mahasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data akademik atau mahasiswa tidak ditemukan'
            ], 403);
        }

        // validasi cek jadwal kkn

        // dapatkan tahun akademik yang sedang aktif
        $tahunAktif = TahunAkademik::where('aktif', true)->first();

        if (!$tahunAktif) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada tahum akademik yang aktif'
            ], 422);
        }

        // Mencari jadwal kkn yang sesuai

    }
}
