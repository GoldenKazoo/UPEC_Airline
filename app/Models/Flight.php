<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        'flight_number',
        'departure_airport_id',
        'arrival_airport_id',
        'departure_time',
        'arrival_time',
        'seats_available',
        'price',
    ];
    
    public function departureAirport()
    {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function numberOfPassengers()
{
    return $this->reservations()->count();
}

public function seatsLeft()
{
    return $this->seats_available - $this->numberOfPassengers();
}
}
