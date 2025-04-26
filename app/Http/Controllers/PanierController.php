<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Reservation;
use App\Models\Passenger;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function add(Flight $flight)
    {
        $panier = session()->get('panier', []);
        $panier[$flight->id] = $flight;
        session()->put('panier', $panier);

        return redirect()->route('panier.index')->with('success', 'Vol ajouté au panier !');
    }

    public function index()
    {
        $panier = session()->get('panier', []);
        return view('panier.index', compact('panier'));
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'number_of_passengers' => 'required|integer|min:1',
        ]);
    
        $panier = session()->get('panier', []);
        $reservations = [];
    
        foreach ($panier as $flight) {
            $reservation = Reservation::create([
                'flight_id' => $flight['id'],
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ]);
    
            Passenger::create([
                'reservation_id' => $reservation->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);
    
            for ($i = 1; $i < $request->number_of_passengers; $i++) {
                Passenger::create([
                    'reservation_id' => $reservation->id,
                    'first_name' => 'Passager ' . $i,
                    'last_name' => 'Inconnu',
                ]);
            }
    
            $reservations[] = $reservation;
        }
    
        session()->forget('panier');
    
        return view('panier.confirmation', compact('reservations'));
    }
    


}
