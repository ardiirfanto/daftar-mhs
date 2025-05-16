<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model untuk tabel fakultas.
 * Menyimpan data fakultas dan relasinya dengan prodi.
 */
class Fakultas extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model ini.
     *
     * @var string
     */
    protected $table = 'fakultas';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_fakultas',
        'kode_fakultas',
        'deskripsi',
    ];

    /**
     * Relasi satu ke banyak: Fakultas memiliki banyak Prodi.
     *
     * @return HasMany
     */
    public function prodi(): HasMany
    {
        return $this->hasMany(Prodi::class);
    }
}
