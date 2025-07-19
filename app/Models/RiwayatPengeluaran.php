<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatPengeluaran extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';

    protected $fillable = [
        'tgl_keluar',
        'id_bahan',
        'jumlah',
        'user_id',
    ];

    // Akses format tanggal untuk tgl_keluar
    public function getTglKeluarAttribute($value)
    {
        return Carbon::parse($value)->translatedFormat('d F Y');
    }

    public function namabahan()
{
    return $this->belongsTo(Namabahan::class, 'id_bahan');
}

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
