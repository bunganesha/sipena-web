<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawais';
    protected $fillable = [
        'nip',
        'nama',
        'jabatan',
        'divisi',
        'jatah_cuti',
        'sisa_cuti',
        'status'
    ];
    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }
}
