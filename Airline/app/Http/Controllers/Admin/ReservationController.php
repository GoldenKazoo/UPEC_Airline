<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Vol;
use App\Models\Passager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{

    public function index()
    {
        $reservations = Reservation::with(['vol', 'passagers'])->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    // Afficher le formulaire de réservation pour le vol sélectionné
    public function create($volId)
    {
        $vol = Vol::findOrFail($volId);
        return view('reservation.create', compact('vol'));
    }

    // Ajouter le vol et les passagers au panier (session)
    public function addToPanier(Request $request)
    {
        $request->validate([
            'vol_id' => 'required|exists:vols,id',
            'prenom' => 'required|array|min:1',
            'prenom.*' => 'required|string|max:255',
            'nom' => 'required|array|min:1',
            'nom.*' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $panier = Session::get('panier', []);

        $panier[] = [
            'vol_id' => $request->vol_id,
            'prenoms' => $request->prenom,
            'noms' => $request->nom,
            'email' => $request->email,
        ];

        Session::put('panier', $panier);

        return redirect()->route('panier.show')->with('success', 'Vol ajouté au panier.');
    }

    // Afficher le contenu du panier
    public function showPanier()
    {
        $panier = Session::get('panier', []);
        $flights = [];
        foreach ($panier as $item) {
            $flights[] = [
                'vol' => Vol::with(['aeroportDepart', 'aeroportArrivee'])->find($item['vol_id']),
                'prenoms' => $item['prenoms'],
                'noms' => $item['noms'],
                'email' => $item['email'],
            ];
        }
        return view('reservation.panier', compact('flights'));
    }

    // Confirmer l'achat et enregistrer toutes les réservations et passagers
    public function confirmPurchase()
    {
        $panier = Session::get('panier', []);
        if (empty($panier)) {
            return redirect()->route('ticket.showFly')->with('error', 'Le panier est vide.');
        }

        $reservationsSummary = [];

        foreach ($panier as $item) {
            $reservation = new Reservation();
            $reservation->vol_id = $item['vol_id'];
            $reservation->user_id = Auth::id();
            $reservation->email = $item['email'];
            $reservation->save();

            $passagers = [];
            for ($i = 0; $i < count($item['prenoms']); $i++) {
                $passager = new Passager();
                $passager->reservation_id = $reservation->id;
                $passager->prenom = $item['prenoms'][$i];
                $passager->nom = $item['noms'][$i];
                //$passager->email = $item['email'];
                $passager->save();

                $passagers[] = $passager;
            }

            $vol = Vol::find($item['vol_id']);

            $reservationsSummary[] = [
                'vol' => $vol,
                'passagers' => $passagers,
                'email' => $item['email'],
            ];
        }

        Session::forget('panier');

        return redirect()->route('reservation.confirmation');
    }

    // Afficher la page de confirmation
    public function confirmation()
    {
        return view('reservation.confirmation');
    }
}
