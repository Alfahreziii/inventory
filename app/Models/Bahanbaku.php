<?php

namespace App\Models;

use Carbon\Carbon; // Tambahkan ini
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bahanbaku extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';

    protected $fillable = [
        'tgl_kadaluarsa',
        'tgl_masuk',
        'id_bahan',
        'sisa',
        'harga_total',
    ];

    // Akses format tanggal untuk tgl_kadaluarsa
    public function getTglKadaluarsaAttribute($value)
    {
        return Carbon::parse($value)->translatedFormat('d F Y');
    }

    // Akses format tanggal untuk tgl_masuk
    public function getTglMasukAttribute($value)
    {
        return Carbon::parse($value)->translatedFormat('d F Y');
    }
}
