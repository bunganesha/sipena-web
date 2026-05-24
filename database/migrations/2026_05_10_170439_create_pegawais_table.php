<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->string('nip')->primary();

            $table->unsignedBigInteger('id_user')->unique();

            $table->string('nama');
            $table->string('jabatan');
            $table->string('divisi');

            $table->integer('jatah_cuti')->default(12);
            $table->integer('sisa_cuti')->default(12);

            $table->enum('status', ['aktif', 'nonaktif']);

            $table->timestamps();

            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};