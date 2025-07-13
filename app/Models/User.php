<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'telepon',
        'instansi',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function pendaftarans(): HasMany
    {
        return $this->hasMany(\App\Models\SriPendaftaran::class, 'user_id');
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(SriEvent::class, 'sri_pendaftaran', 'user_id', 'event_id')
            ->withPivot('status_pendaftaran', 'created_at')
            ->withTimestamps();
    }
}
