<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('nim')->unique();
            $table->foreignId('prodi_id')->constrained('prodi');
            $table->string('tahun_masuk', 4);
            $table->enum('status', ['aktif', 'cuti', 'lulus', 'drop out'])->default('aktif');
            $table->text('alamat')->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->string('judul_skripsi')->nullable();
            $table->string('dosen_pembimbing')->nullable();
            $table->enum('status_skripsi', ['belum_mulai', 'proposal', 'penelitian', 'sidang', 'selesai'])->default('belum_mulai');
            $table->date('tanggal_mulai_skripsi')->nullable();
            $table->date('tanggal_sidang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
