<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SriKategori extends Model
{
    use HasFactory;

    protected $table = 'sri_kategori';
    
    protected $fillable = [
        'nama_kategori',
    ];

    public function events()
    {
        return $this->hasMany(SriEvent::class, 'kategori_id');
    }
}
