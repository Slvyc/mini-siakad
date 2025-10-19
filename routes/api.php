<?php

use App\Http\Controllers\Api\MahasiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);
Route::post('/mahasiswa/create', [MahasiswaController::class, 'store']);
Route::put('/mahasiswa/update/{id}', [MahasiswaController::class, 'update']);
Route::delete('/mahasiswa/delete/{id}', [MahasiswaController::class, 'destroy']);
