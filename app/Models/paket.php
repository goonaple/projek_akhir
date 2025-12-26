<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class paket extends Model
{
    protected $table = 'pakets';

    protected $primaryKey = 'id_paket';

    public $incrementing = true;

    protected $fillable = [
        'nama_paket',
        'harga_paket',
    ];

    protected $guarded = ['id_paket'];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'paket_id', 'id_paket');
    }

     public function galleries()
    {
        return $this->hasMany(Gallery::class, 'id_paket', 'id_paket');
    }
}
