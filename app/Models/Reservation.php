<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function reservation_details()
    {
        return $this->hasMany(ReservationDetails::class, 'reservation_id', 'id');
    }
}
