<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Memberitahu Laravel bahwa model ini menggunakan tabel "produk"
    protected $table = 'produk'; 
    protected $guarded = [];

    // Relasi ke tabel toko (karena di PDM foreign key-nya 'toko_id')
    public function toko()
    {
        return $this->belongsTo(Toko::class, 'toko_id');
    }
}
