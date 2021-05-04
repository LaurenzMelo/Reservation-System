<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'amount',
        'capacity',
        'capacity_extend',
        'is_occupied',
        'image',
        'amenities',
    ];

    public function reservation_details()
    {
        return $this->hasMany(ReservationDetails::class);
    }
}
