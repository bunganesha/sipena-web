<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_user')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('divisi');

            $table->integer('jatah_cuti')->default(12);
            $table->integer('sisa_cuti')->default(12);

            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
