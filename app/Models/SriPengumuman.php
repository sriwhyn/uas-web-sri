<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder; 

class SriPengumuman extends Model
{
    use HasFactory;

    protected $table = 'sri_pengumuman';

    protected $fillable = [
        'judul',
        'isi',
    ];

    
    public function scopeAktif(Builder $query): void
    {
        $query->where('is_aktif', true);
    }
}
