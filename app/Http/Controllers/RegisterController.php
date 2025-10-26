<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $prodis = Prodi::all();
        return view('register', compact('prodis'));
    }

    public function store(Request $request)
    {

        $request->validate([
            //tabel user 
            'name' => 'required|string',
            'nim' => 'required|string|unique:users',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',

            //table mahasiswa 
            'prodi_id' => 'required|exists:prodi,id',
            'jenis_kelamin' => 'required|in:L,P',
        ], [
            'nim.unique' => 'Nim Sudah Terdaftar',
            'password.confirmed' => 'Konfirmasi Password Salah',
            'prodi_id.exists' => 'Prodi Tidak Ada',
            'prodi_id.required' => 'Prodi Tidak Boleh Kosong',
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'jenis_kelamin.required' => 'Jenis Kelamin Tidak Boleh Kosong',
            'jenis_kelamin.in' => 'Jenis Kelamin Tidak Valid',
            'name.required' => 'Nama Tidak Boleh Kosong',
            'email.required' => 'Email Tidak Boleh Kosong',
            'email.email' => 'Email Tidak Valid',
            'password.required' => 'Password Tidak Boleh Kosong',
            'password.min' => 'Password Minimal 8 Karakter',
        ]);

        try {
            //simpan ke tabel users
            $user = User::create([
                'name' => $request->name,
                'nim' => $request->nim,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'mahasiswa', //default role peserta
            ]);

            //simpan ke tabel pendaftarans
            Mahasiswa::create([
                'user_id' => $user->id,
                'prodi_id' => $request->prodi_id,
                'nama' => $user->name,
                'jenis_kelamin' => $request->jenis_kelamin,
                'jumlah_sks' => 0,
                'status' => 'aktif',

            ]);

            // Auth::login($user);

            return redirect()->route('login')
                ->with('success', 'Registrasi berhasil!');
            // return redirect()->with('success', 'Registrasi Berhasil');
        } catch (\Exception $e) {
            // dd($e->getMessage(), $e->getTraceAsString());
            // dd($e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mendaftar.'])->withInput();
        }
    }
}
