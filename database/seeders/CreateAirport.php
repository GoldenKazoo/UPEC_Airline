<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airport;

class CreateAirport extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airports = [
            ['name' => 'Paris Charles de Gaulle', 'code' => 'CDG'],
            ['name' => 'Eorzea', 'code' => 'EOR'],
            ['name' => 'Bordeciel', 'code' => 'BOR'],
            ['name' => 'Yggdrasil', 'code' => 'YGG'],
        ];

        foreach ($airports as $airport) {
            Airport::create($airport);
        }
    }
}

