<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fakultas extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fakultas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_fakultas',
        'kode_fakultas',
        'deskripsi',
    ];

    /**
     * Get the prodi for the fakultas.
     */
    public function prodi(): HasMany
    {
        return $this->hasMany(Prodi::class);
    }
}
