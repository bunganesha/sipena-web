<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalLog extends Model
{
    protected $fillable = [
        'pengajuan_id',
        'role',
        'status',
        'alasan'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
