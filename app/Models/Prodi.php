<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';

    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'prodi_id');
    }

    public function jadwalKkns()
    {
        return $this->hasMany(JadwalKkn::class, 'prodi_id');
    }
}
