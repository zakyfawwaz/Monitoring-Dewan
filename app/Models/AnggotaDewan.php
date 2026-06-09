<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AnggotaDewan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model.
     *
     * @var string
     */
    protected $table = 'anggota_dewans';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'nikd',
        'jabatan',
        'komisi',
        'fraksi',
        'nomor_hp',
        'foto',
        'status_aktif',
    ];

    /**
     * Atribut yang harus di-cast ke tipe native.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status_aktif' => 'boolean',
    ];

    // =========================================================================
    // RELASI
    // =========================================================================

    /**
     * Anggota dewan memiliki banyak aktivitas.
     */
    public function aktivitas(): HasMany
    {
        return $this->hasMany(Aktivitas::class);
    }

    /**
     * Anggota dewan terkait dengan satu akun user.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    // =========================================================================
    // SCOPES
    // =========================================================================

    /**
     * Scope: hanya anggota yang aktif.
     */
    public function scopeAktif($query)
    {
        return $query->where('status_aktif', true);
    }

    /**
     * Scope: hanya anggota yang tidak aktif.
     */
    public function scopeTidakAktif($query)
    {
        return $query->where('status_aktif', false);
    }

    // =========================================================================
    // ACCESSOR
    // =========================================================================

    /**
     * Mendapatkan URL foto anggota, atau placeholder jika tidak ada.
     */
    public function getFotoUrlAttribute(): string
    {
        return $this->foto
            ? asset('storage/' . $this->foto)
            : asset('images/default-avatar.png');
    }
}
