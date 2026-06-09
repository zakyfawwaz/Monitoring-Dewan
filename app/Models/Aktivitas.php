<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aktivitas extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model.
     *
     * @var string
     */
    protected $table = 'aktivitas';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'anggota_dewan_id',
        'tanggal',
        'waktu',
        'nama_kegiatan',
        'kategori',
        'lokasi',
        'deskripsi_kegiatan',
        'dokumentasi_foto',
        'dibuat_oleh',
    ];

    /**
     * Atribut yang harus di-cast ke tipe native.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal' => 'date',
        'waktu'   => 'string',
    ];

    // =========================================================================
    // KONSTANTA KATEGORI
    // =========================================================================

    /**
     * Kategori kegiatan yang dikelompokkan berdasarkan jenis.
     */
    public const KATEGORI_DPRD = [
        'paripurna'  => 'Paripurna',
        'komisi'     => 'Komisi',
        'fraksi'     => 'Fraksi',
        'pansus'     => 'Pansus',
    ];

    public const KATEGORI_MASYARAKAT = [
        'reses'       => 'Reses',
        'aspirasi'    => 'Aspirasi',
        'sosialisasi' => 'Sosialisasi',
    ];

    public const KATEGORI_LAPANGAN = [
        'monitoring' => 'Monitoring',
        'inspeksi'   => 'Inspeksi',
    ];

    public const KATEGORI_LAINNYA = [
        'audiensi' => 'Audiensi',
        'seminar'  => 'Seminar',
        'mendadak' => 'Mendadak',
    ];

    /**
     * Mendapatkan semua kategori sebagai flat array [value => label].
     */
    public static function semuaKategori(): array
    {
        return array_merge(
            self::KATEGORI_DPRD,
            self::KATEGORI_MASYARAKAT,
            self::KATEGORI_LAPANGAN,
            self::KATEGORI_LAINNYA
        );
    }

    /**
     * Mendapatkan kategori yang sudah dikelompokkan.
     */
    public static function kategoriGrouped(): array
    {
        return [
            'DPRD'       => self::KATEGORI_DPRD,
            'Masyarakat' => self::KATEGORI_MASYARAKAT,
            'Lapangan'   => self::KATEGORI_LAPANGAN,
            'Lainnya'    => self::KATEGORI_LAINNYA,
        ];
    }

    // =========================================================================
    // RELASI
    // =========================================================================

    /**
     * Aktivitas milik satu anggota dewan.
     */
    public function anggotaDewan(): BelongsTo
    {
        return $this->belongsTo(AnggotaDewan::class);
    }

    /**
     * Aktivitas dibuat oleh satu user (creator).
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    // =========================================================================
    // SCOPES
    // =========================================================================

    /**
     * Scope: filter berdasarkan kategori.
     */
    public function scopeKategori($query, string $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope: filter berdasarkan tanggal hari ini.
     */
    public function scopeHariIni($query)
    {
        return $query->whereDate('tanggal', today());
    }

    /**
     * Scope: filter berdasarkan bulan tertentu.
     */
    public function scopeBulan($query, int $bulan, ?int $tahun = null)
    {
        $tahun = $tahun ?? now()->year;
        return $query->whereMonth('tanggal', $bulan)
                     ->whereYear('tanggal', $tahun);
    }

    /**
     * Scope: filter berdasarkan tahun tertentu.
     */
    public function scopeTahun($query, int $tahun)
    {
        return $query->whereYear('tanggal', $tahun);
    }

    /**
     * Scope: filter berdasarkan rentang tanggal (untuk triwulan & semester).
     */
    public function scopeRentangTanggal($query, string $dari, string $sampai)
    {
        return $query->whereBetween('tanggal', [$dari, $sampai]);
    }

    /**
     * Scope: filter berdasarkan anggota dewan tertentu.
     */
    public function scopeMilikAnggota($query, int $anggotaDewanId)
    {
        return $query->where('anggota_dewan_id', $anggotaDewanId);
    }

    // =========================================================================
    // ACCESSOR
    // =========================================================================

    /**
     * Mendapatkan label kategori yang user-friendly.
     */
    public function getLabelKategoriAttribute(): string
    {
        return self::semuaKategori()[$this->kategori] ?? ucfirst($this->kategori);
    }

    /**
     * Mendapatkan URL dokumentasi foto, atau null jika tidak ada.
     */
    public function getDokumentasiFotoUrlAttribute(): ?string
    {
        return $this->dokumentasi_foto
            ? asset('storage/' . $this->dokumentasi_foto)
            : null;
    }
}
