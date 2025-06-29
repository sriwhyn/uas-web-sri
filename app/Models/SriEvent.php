<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SriEvent extends Model
{
    use HasFactory;

    protected $table = 'sri_event'; // Nama tabel tunggal

    protected $fillable = [
        'judul', // Diubah dari 'nama_event'
        'deskripsi',
        'tanggal_pelaksanaan', 
        'lokasi',
        'kuota',
        'gambar',
        'kategori_id',
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'datetime',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    // Accessor untuk tanggal (maps ke tanggal_pelaksanaan)
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
}
