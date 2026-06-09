<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'anggota_dewan_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // =========================================================================
    // RELASI
    // =========================================================================

    /**
     * User terkait dengan satu anggota dewan (jika role = anggota).
     */
    public function anggotaDewan(): BelongsTo
    {
        return $this->belongsTo(AnggotaDewan::class);
    }

    /**
     * User membuat banyak aktivitas (sebagai creator).
     */
    public function aktivitasDibuat(): HasMany
    {
        return $this->hasMany(Aktivitas::class, 'dibuat_oleh');
    }

    // =========================================================================
    // HELPER METHODS
    // =========================================================================

    /**
     * Cek apakah user adalah Admin Fraksi.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah Anggota Dewan.
     */
    public function isAnggota(): bool
    {
        return $this->role === 'anggota';
    }
}

