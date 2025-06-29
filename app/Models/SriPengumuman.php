<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder; // Import Builder untuk scope

class SriPengumuman extends Model
{
    use HasFactory;

    protected $table = 'sri_pengumuman';

    protected $fillable = [
        'judul',
        'isi',
    ];

    /**
     * Scope: Hanya pengumuman yang aktif (is_aktif = true).
     */
    public function scopeAktif(Builder $query): void
    {
        $query->where('is_aktif', true);
    }
}
