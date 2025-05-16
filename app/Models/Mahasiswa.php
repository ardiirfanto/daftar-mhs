<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model untuk tabel mahasiswa.
 * Menyimpan data mahasiswa beserta relasi ke user dan prodi.
 */
class Mahasiswa extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model ini.
     *
     * @var string
     */
    protected $table = 'mahasiswa';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nim',
        'prodi_id',
        'tahun_masuk',
        'status',
        'alamat',
        'no_hp',
        'judul_skripsi',
        'dosen_pembimbing',
        'status_skripsi',
        'tanggal_mulai_skripsi',
        'tanggal_sidang',
    ];

    /**
     * Relasi ke user yang memiliki mahasiswa ini.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke prodi yang dimiliki mahasiswa ini.
     *
     * @return BelongsTo
     */
    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class);
    }
}
