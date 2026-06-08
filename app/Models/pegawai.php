<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nip',
        'nama',
        'jabatan',
        'divisi',
        'jatah_cuti',
        'sisa_cuti',
        'status',
    ];

    // RELASI ABSENSI
    public function absensis()
    {
        return $this->hasMany(
            Absensi::class,
            'pegawai_id'
        );
    }

    // RELASI PENGAJUAN
    public function pengajuans()
    {
        return $this->hasMany(
            Pengajuan::class,
            'pegawai_id'
        );
    }

    // RELASI USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}