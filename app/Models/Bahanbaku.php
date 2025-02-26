<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bahanbaku extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_bahan',
        'tgl_kadaluarsa',
        'tgl_masuk',
        'harga',
        'sisa',
        'demand',
        'biaya_simpan',
        'biaya_pesan',
        'harga_total',
        'nilai_x',
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
