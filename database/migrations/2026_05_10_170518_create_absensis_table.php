<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id('id_absensi');

            $table->string('nip');

            $table->date('tanggal');

            $table->time('jam_masuk')->nullable();
            $table->time('jam_keluar')->nullable();

            $table->enum('status_absensi', [
                'hadir',
                'izin',
                'sakit',
                'alpha'
            ]);

            $table->text('keterangan')->nullable();

            $table->timestamps();

            $table->foreign('nip')
                  ->references('nip')
                  ->on('pegawais')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};