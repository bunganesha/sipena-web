<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();

            // RELASI KE PEGAWAI
            $table->foreignId('pegawai_id')
                ->constrained('pegawais')
                ->onDelete('cascade');

            $table->enum('jenis_pengajuan', ['cuti', 'izin', 'sakit']);

            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');

            $table->text('alasan');

            // APPROVAL FLOW
            $table->enum('status_spv', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_spv')->nullable();

            $table->enum('status_manager', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_manager')->nullable();

            $table->enum('status_hrd', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_hrd')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};