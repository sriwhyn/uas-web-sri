<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SriPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'sri_pendaftaran';
    
    protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'kode_pendaftaran',
        'tanggal_daftar',
        'nama',
        'nim',
        'jurusan',
        'prodi',
        'institusi',
        'status_pendaftaran'
    ];

    protected $casts = [
        'tanggal_daftar' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(SriEvent::class, 'event_id');
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->kode_pendaftaran)) {
                $model->kode_pendaftaran = 'REG-' . strtoupper(Str::random(8));
            }
            if (empty($model->tanggal_daftar)) {
                $model->tanggal_daftar = now();
            }
        });
    }
}
