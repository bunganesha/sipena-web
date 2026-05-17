<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
    'id_user',
    'nip',
    'nama',
    'jabatan',
    'divisi',
    'jatah_cuti'        
    ];
}