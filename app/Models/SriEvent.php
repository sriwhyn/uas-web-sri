<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SriEvent extends Model
{
    use HasFactory;

    protected $table = 'sri_event'; 

    protected $fillable = [
        'judul', 
        'deskripsi',
        'tanggal_pelaksanaan',
        'lokasi',
        'kuota',
        'gambar',
        'kategori_id',
        'penyelenggara',
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'datetime',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    
    public function getTanggalAttribute()
    {
        return $this->tanggal_pelaksanaan;
    }

    public function kategori()
    {
        return $this->belongsTo(SriKategori::class, 'kategori_id');
    }

    public function pendaftarans()
    {
        return $this->hasMany(SriPendaftaran::class, 'event_id');
    }

    public function getSisaKuotaAttribute()
    {
        if (is_null($this->kuota)) return null;
        return $this->kuota - $this->pendaftarans->count();
    }
}
