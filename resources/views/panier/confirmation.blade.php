@extends('template_client')

@section('content')
<div class="container mt-5">

    @if(count($reservations) > 0)
        <h2 class="text-center mb-4">Confirmation de votre reservation</h2> ¬‿¬

        <div class="alert alert-success text-center">
            Merci {{ $reservations[0]->first_name }} pour votre reservation ! ¬‿¬
        </div>

        @foreach($reservations as $reservation)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Vol : {{ $reservation->flight->flight_number }}</h5>

                    <table class="table">
                        <tr>
                            <th>Départ</th>
                            <td>{{ $reservation->flight->departureAirport->name }} ({{ $reservation->flight->departureAirport->code }})</td>
                        </tr>
                        <tr>
                            <th>Arrivée</th>
                            <td>{{ $reservation->flight->arrivalAirport->name }} ({{ $reservation->flight->arrivalAirport->code }})</td>
                        </tr>
                        <tr>
                            <th>Date de départ</th>
                            <td>{{ \Carbon\Carbon::parse($reservation->flight->departure_time)->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Date d'arrivée</th>
                            <td>{{ \Carbon\Carbon::parse($reservation->flight->arrival_time)->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Email utilisé</th>
                            <td>{{ $reservation->email }}</td>
                        </tr>
                        <tr>
                            <th>Nom du passager principal</th>
                            <td>{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Nombre de passagers</th>
                            <td>{{ $reservation->passengers()->count() }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        @endforeach

        <div class="text-center">
            <a href="{{ route('flights.index') }}" class="btn btn-primary">Retour à la liste des vols</a>
        </div>

    @else
        <div class="alert alert-warning text-center">
            Aucune réservation trouvée.
        </div>
    @endif

</div>
@endsection
