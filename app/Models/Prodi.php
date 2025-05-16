<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model untuk tabel prodi.
 * Menyimpan data program studi dan relasinya dengan fakultas serta mahasiswa.
 */
class Prodi extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model ini.
     *
     * @var string
     */
    protected $table = 'prodi';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_prodi',
        'kode_prodi',
        'fakultas_id',
        'deskripsi',
    ];

    /**
     * Relasi ke fakultas yang memiliki prodi ini.
     *
     * @return BelongsTo
     */
    public function fakultas(): BelongsTo
    {
        return $this->belongsTo(Fakultas::class);
    }

    /**
     * Relasi satu ke banyak: Prodi memiliki banyak Mahasiswa.
     *
     * @return HasMany
     */
    public function mahasiswa(): HasMany
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
