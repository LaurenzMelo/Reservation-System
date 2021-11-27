<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $appends = ['full_name'];

    protected $fillable = [
        'reservation_no',
        'amount',
        'guest_no',
        'is_paid',
        'deposit_img',
        'bank',
        'time_deposited',
        'name',
        'email',
        'contact_no',
        'requests'
    ];

    public function reservation_details()
    {
        return $this->hasMany(ReservationDetails::class, 'reservation_id', 'id');
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class, 'reservation_id','id');
    }

    public function amenities()
    {
        return $this->hasOne(Amenities::class, 'reservation_id','id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
