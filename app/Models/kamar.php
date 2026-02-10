<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
     protected $table = 'kamars';

    protected $primaryKey = 'id_kamar';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_kamar',
        'nomor_kamar',
        'tipe_kamar',
        'harga_kamar',
        'status_kamar',
    ];

    /**
     * Relasi: 1 kamar punya banyak reservasi
     */
    public function reservasis()
    {
        return $this->hasMany(Reservasi::class, 'id_kamar', 'id_kamar');
    }
}
