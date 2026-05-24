<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();

            // RELASI KE PEGAWAI (FIX)
            $table->foreignId('pegawai_id')
                ->constrained('pegawais')
                ->onDelete('cascade');

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

            // OPTIONAL: cegah double absensi per hari
            $table->unique(['pegawai_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};