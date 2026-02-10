<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasis';
    protected $primaryKey = 'id_reservasi';

    protected $fillable = [
        'id_kamar',
        'nama_tamu',
        'no_hp',
        'check_in',
        'check_out',
        'jumlah_tamu',
        'total_bayar',
        'status_reservasi'
    ];

    /**
     * Relasi: 1 reservasi milik 1 kamar
     */
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar', 'id_kamar');
    }
}
