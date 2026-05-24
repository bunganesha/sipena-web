<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuans';

    protected $primaryKey = 'id';

    protected $fillable = [
        'pegawai_id',
        'jenis_pengajuan',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'status_spv',
        'catatan_spv',
        'status_manager',
        'catatan_manager',
        'status_hrd',
        'catatan_hrd',
    ];

    // RELASI KE PEGAWAI
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}