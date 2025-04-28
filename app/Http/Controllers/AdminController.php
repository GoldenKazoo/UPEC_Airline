<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function flights()
    {
        $flights = Flight::all();
        return view('admin.flights.index', compact('flights'));
    }

    public function createFlight()
    {
        return view('admin.flights.create');
    }

    public function storeFlight(Request $request)
    {
        $validated = $request->validate([
            'flight_number' => 'required|unique:flights',
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id' => 'required|exists:airports,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
            'seats_available' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Flight::create($validated);

        return redirect()->route('admin.flights')->with('success', 'Vol ajouté avec succès !');
    }

    public function editFlight(Flight $flight)
    {
        return view('admin.flights.edit', compact('flight'));
    }

    public function updateFlight(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'flight_number' => 'required',
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id' => 'required|exists:airports,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
            'seats_available' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $flight->update($validated);

        return redirect()->route('admin.flights')->with('success', 'Vol modifié avc succès !');
    }

    public function deleteFlight(Flight $flight)
    {
        $flight->delete();
        return redirect()->route('admin.flights')->with('success', 'Vol supprimé avc succès !');
    }

    public function reservations()
    {
        $reservations = Reservation::with('flight')->get();
        return view('admin.reservations.index', compact('reservations'));
    }
}
