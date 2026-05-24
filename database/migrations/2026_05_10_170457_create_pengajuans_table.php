<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id('id_pengajuan');

            $table->string('nip');

            $table->string('jenis_pengajuan');

            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');

            $table->text('alasan');

            $table->enum('status_approval', [
                'pending',
                'disetujui',
                'ditolak'
            ])->default('pending');

            $table->timestamps();

            $table->foreign('nip')
                  ->references('nip')
                  ->on('pegawais')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};