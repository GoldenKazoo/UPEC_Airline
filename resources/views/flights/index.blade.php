@extends('template_client')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('flights.index') }}">
            <div class="row">
                <div class="col-md-3">
                    <input type="date" name="departure_date" class="form-control" value="{{ request('departure_date') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="arrival_date" class="form-control"value="{{ request('arrival_date') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="departure_airport" class="form-control" placeholder= "Depart" value="{{ request('departure_airport') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="arrival_airport" class="form-control" placeholder="Arrivée" value="{{ request('arrival_airport') }}">
                </div>
            </div>
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </form>
    </div>
</div>

<div class="container mt-3">
    <h1 class="mb-5">Liste des Vols</h1>
    
    <div class="row">
        @foreach($flights as $flight)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $flight->flight_number }}</h5>
                        <p class="card-text">
                            <strong>Départ :</strong> {{ $flight->departureAirport->name }}<br>
                            <strong>Arrivée :</strong> {{ $flight->arrivalAirport->name }}<br>
                            <strong>Date de départ :</strong> {{ $flight->departure_time }}<br>
                            <strong>Date d'arrivée :</strong> {{ $flight->arrival_time }}<br>
                            <strong>Prix :</strong> {{ $flight->price }} €
                        </p>
                    </div>
                </div>
                <form action="{{ route('panier.add', $flight->id) }}" method="POST" class="mt-1">
                <button type="submit" class="btn btn-success">Ajouter au Panier</button>
            </div>
    @csrf
    <br>
</form>

        @endforeach
    </div>
</div>
@endsection
