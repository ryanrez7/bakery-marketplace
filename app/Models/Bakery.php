<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bakery extends Model
{
    public const STATUS_PENDING  = 'PENDING';
    public const STATUS_ACTIVE   = 'ACTIVE';
    public const STATUS_REJECTED = 'REJECTED';

    public const JENIS_USAHA = [
        'Toko Roti', 'Toko Kue', 'Patisserie', 'Home Bakery', 'Cafe & Bakery',
    ];

    // 25 kecamatan di Kabupaten Banyuwangi
    public const KECAMATAN = [
        'Banyuwangi', 'Giri', 'Glagah', 'Kabat', 'Rogojampi',
        'Singojuruh', 'Songgon', 'Cluring', 'Gambiran', 'Genteng',
        'Glenmore', 'Kalibaru', 'Kalipuro', 'Licin', 'Muncar',
        'Pesanggaran', 'Purwoharjo', 'Sempu', 'Siliragung', 'Srono',
        'Tegaldlimo', 'Tegalsari', 'Wongsorejo', 'Bangorejo', 'Blimbingsari',
    ];

    protected $fillable = [
        'nama', 'slug', 'jenis_usaha', 'alamat', 'kecamatan', 'email', 'whatsapp',
        'status', 'alasan_penolakan',
        'ktp_path', 'izin_usaha_path', 'foto_toko_path', 'dokumen_lain_path',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }
}