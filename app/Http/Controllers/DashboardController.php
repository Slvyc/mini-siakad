<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('mahasiswa');
        $userprodi = auth()->user()->load('mahasiswa.prodi');
        return view('mahasiswa.dashboard', compact('user', 'userprodi'));
    }
}
