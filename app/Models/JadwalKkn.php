<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKkn extends Model
{
    protected $table = 'jadwal_kkn';

    protected $fillable = [
        'prodi_id',
        'tahun_akademik_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
        'status_pendaftaran'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik_id');
    }
}
