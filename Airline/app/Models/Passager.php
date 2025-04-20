<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passager extends Model
{
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

}
