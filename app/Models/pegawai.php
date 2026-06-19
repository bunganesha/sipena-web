<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Pengajuan;
use App\Models\Absensi;

class Pegawai extends Model
{
    protected $table = 'pegawais';

    protected $fillable = [
        'id_user',
        'nip',
        'nama',
        'jabatan',
        'divisi',
        'jatah_cuti',
        'sisa_cuti',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'pegawai_id');
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'pegawai_id');
    }
}