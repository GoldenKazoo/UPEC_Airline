@extends('template')

@section('title', 'Confirmation de réservation')

@section('content')
<div class="container mt-5">
    <h2>Merci pour votre achat !</h2>

    @php
        $reservationsSummary = session('reservationsSummary', []);
    @endphp

    @foreach($reservationsSummary as $reservation)
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $reservation['vol']->aeroportDepart->nom }} → {{ $reservation['vol']->aeroportArrivee->nom }}</h5>
                <p class="card-text">
                    Départ : {{ \Carbon\Carbon::parse($reservation['vol']->date_depart->format('Y-m-d') . ' ' . \Carbon\Carbon::parse($reservation['vol']->heure_depart)->format('H:i:s'))->format('d/m/Y H:i') }}<br>
                    Arrivée : {{ \Carbon\Carbon::parse($reservation['vol']->date_arrivee->format('Y-m-d') . ' ' . \Carbon\Carbon::parse($reservation['vol']->heure_arrivee)->format('H:i:s'))->format('d/m/Y H:i') }}<br>
                    Prix : {{ number_format($reservation['vol']->prix, 2, ',', ' ') }} €
                </p>
                <p>Passagers :</p>
                <ul>
                    @foreach($reservation['passagers'] as $passager)
                        <li>{{ $passager->prenom }} {{ $passager->nom }}</li>
                    @endforeach
                </ul>
                <p>Email : {{ $reservation['email'] }}</p>
            </div>
        </div>
    @endforeach
</div>

<a href="{{ route('ticket.showFly') }}" class="btn btn-secondary mt-3">Retour à la billetterie</a>
@endsection
