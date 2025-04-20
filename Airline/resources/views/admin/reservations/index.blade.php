@extends('template')

@section('content')
<div class="container">
    <h2>Réservations effectuées</h2>

    @foreach($reservations as $reservation)
        <div class="card mb-4">
            <div class="card-body">
                <h5>Vol n° {{ $reservation->vol->numero_vol }} ({{ $reservation->vol->aeroport_depart_id }} → {{ $reservation->vol->aeroport_arrivee_id }})</h5>
                <p>Email : {{ $reservation->email }}</p>
                <p>Passagers :</p>
                <ul>
                    @foreach($reservation->passagers as $p)
                        <li>{{ $p->prenom }} {{ $p->nom }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>
@endsection
