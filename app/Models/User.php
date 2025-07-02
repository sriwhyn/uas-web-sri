<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Tambahkan ini untuk relasi many-to-many
use App\Models\SriPendaftaran; // Menggunakan model SriPendaftaran yang baru
use App\Models\SriEvent; // Menggunakan model SriEvent yang baru

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Secara eksplisit mendefinisikan nama tabel

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Menggunakan 'role' sebagai kolom peran
        'telepon', // Menambahkan kolom 'telepon'
        'instansi', // Menambahkan kolom 'instansi'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed', // Laravel 10+ otomatis hash password, tapi jika Anda ingin eksplisit, bisa ditambahkan
    ];

    /**
     * Cek apakah user adalah admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin'; // Memeriksa kolom 'role'
    }

    /**
     * Relasi: User memiliki banyak pendaftaran (one-to-many).
     * Menunjuk ke model SriPendaftaran.
     */
    public function pendaftarans(): HasMany
    {
        return $this->hasMany(SriPendaftaran::class, 'user_id');
    }

    /**
     * Relasi: User memiliki banyak event melalui tabel pendaftaran (many-to-many).
     */
    public function events(): BelongsToMany
    {
        // 'sri_pendaftaran' adalah nama tabel pivot
        // 'user_id' adalah foreign key di tabel pivot yang merujuk ke model User
        // 'sri_event_id' adalah foreign key di tabel pivot yang merujuk ke model SriEvent
        
        return $this->belongsToMany(SriEvent::class, 'sri_pendaftaran', 'user_id', 'sri_event_id')
                    ->withPivot('status_pendaftaran', 'created_at') // Memuat kolom pivot yang relevan
                    ->withTimestamps(); // Jika tabel pivot memiliki created_at dan updated_at
    }
}
