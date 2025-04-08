<?php

namespace App\Http\Controllers;

use App\Models\Flies;
use Illuminate\Http\Request;

class TController extends Controller
{

    public function showFlights(Request $request)
    {
        $query = Flies::query();


        if ($request->departure_airport) {
            $query->where('departure_airport', 'like', '%' . $request->departure_airport . '%');
        }

        if ($request->arrival_airport) {
            $query->where('arrival_airport', 'like', '%' . $request->arrival_airport . '%');
        }

        if ($request->departure_date) {
            $query->where('departure_date', '>=', $request->departure_date);
        }

        if ($request->arrival_date) {
            $query->where('arrival_date', '<=', $request->arrival_date);
        }
        $flights = $query->get();

        return view('billetterie', compact('flights'));
    }
}
