<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawais';
    protected $fillable = [
    'id_user',
    'nip',
    'nama',
    'jabatan',
    'divisi',
    'jatah_cuti'        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}