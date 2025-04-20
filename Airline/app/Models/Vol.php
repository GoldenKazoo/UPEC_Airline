<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vol extends Model
{
    protected $fillable = [
        'numero_vol', 
        'aeroport_depart_id', 
        'aeroport_arrivee_id', 
        'date_depart', 
        'heure_depart', 
        'date_arrivee', 
        'heure_arrivee', 
        'places_disponibles', 
        'prix'
    ];

    public function aeroportDepart()
    {
        return $this->belongsTo(Aeroport::class, 'aeroport_depart_id');
    }

    public function aeroportArrivee()
    {
        return $this->belongsTo(Aeroport::class, 'aeroport_arrivee_id');
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

