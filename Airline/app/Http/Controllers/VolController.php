<?php

namespace App\Http\Controllers;

use App\Models\Vol;
use App\Models\Aeroport;
use Illuminate\Http\Request;

class VolController extends Controller
{
    public function create()
    {
        $aeroports = Aeroport::all();
        return view('vols.create', compact('aeroports'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_vol' => 'required|unique:vols,numero_vol',
            'aeroport_depart_id' => 'required|different:aeroport_arrivee_id',
            'aeroport_arrivee_id' => 'required',
            'date_depart' => 'required|date',
            'heure_depart' => 'required',
            'date_arrivee' => 'required|date|after_or_equal:date_depart',
            'heure_arrivee' => 'required',
            'places_disponibles' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
        ]);

        Vol::create($validated);
        return redirect()->route('vols.create')->with('success', 'Vol créé avec succès !');
    }

    public function deletePage()
    {
        $vols = Vol::with('aeroportDepart', 'aeroportArrivee')->get();
        return view('vols.delete', compact('vols'));
    }

    public function destroy($id)
    {
        $vol = Vol::findOrFail($id);
        $vol->delete();

        return redirect()->route('vols.delete')->with('success', 'Vol supprimé avec succès.');
    }

    // New method to search flights based on filters
    public function searchFlights(Request $request)
    {
        $aeroports = Aeroport::all();

        $query = Vol::query();

        if ($request->filled('departure_airport')) {
            $query->where('aeroport_depart_id', $request->departure_airport);
        }

        if ($request->filled('arrival_airport')) {
            $query->where('aeroport_arrivee_id', $request->arrival_airport);
        }

        if ($request->filled('departure_date')) {
            $query->whereDate('date_depart', $request->departure_date);
        }

        // Removed filtering by heure_depart and heure_arrivee as per user request
        if ($request->filled('arrival_date')) {
            $query->whereDate('date_arrivee', $request->arrival_date);
        }

        $flights = $query->with(['aeroportDepart', 'aeroportArrivee'])->get();

        return view('billetterie', compact('flights', 'aeroports'));
    }
}
