<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function vol()
    {
        return $this->belongsTo(Vol::class);
    }
    
    public function passagers()
    {
        return $this->hasMany(Passager::class);
    }
    
}
