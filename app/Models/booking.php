<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    protected $table = 'bookings';

    protected $primaryKey = 'idBooking';

    public $incrementing = true;

    protected $fillable = [
        'nama',
        'tanggal',
        'no_hp',
        'paket_id',
        'status',
    ];

    protected $guarded = ['idBooking'];

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id', 'id_paket');
    }
    
}
