<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Flight::with(['departureAirport', 'arrivalAirport']);
    
        if ($request->filled('departure_date')) {
            $query->whereDate('departure_time', $request->departure_date);
        }
    
        if ($request->filled('arrival_date')) {
            $query->whereDate('arrival_time', $request->arrival_date);
        }
    
        if ($request->filled('departure_airport')) {
            $query->whereHas('departureAirport', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->departure_airport . '%')
                  ->orWhere('code', 'like', '%' . $request->departure_airport . '%');
            });
        }
    
        if ($request->filled('arrival_airport')) {
            $query->whereHas('arrivalAirport', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->arrival_airport . '%')
                  ->orWhere('code', 'like', '%' . $request->arrival_airport . '%');
            });
        }
    
        $flights = $query->get();
    
        return view('flights.index', compact('flights'));
    }
    
}
