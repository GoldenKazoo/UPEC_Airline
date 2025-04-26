@extends('template_admin')

@section('content')
<div class="container mt-4">
    <h1>Ajouter un Vol</h1>

    <form method="POST" action="{{ route('admin.flights.store') }}">
        @csrf

        <div class="mb-3">
            <input type="text" name="flight_number" class="form-control" placeholder="Numéro de vol" required>
        </div>

        <div class="mb-3">
            <input type="number" name="departure_airport_id" class="form-control" placeholder="ID Aéroport Départ" required>
        </div>

        <div class="mb-3">
            <input type="number" name="arrival_airport_id" class="form-control" placeholder="ID Aéroport Arrivée" required>
        </div>

        <div class="mb-3">
            <input type="datetime-local" name="departure_time" class="form-control" placeholder="Départ" required>
        </div>

        <div class="mb-3">
            <input type="datetime-local" name="arrival_time" class="form-control" placeholder="Arrivée" required>
        </div>

        <div class="mb-3">
            <input type="number" name="seats_available" class="form-control" placeholder="Places disponibles" required>
        </div>

        <div class="mb-3">
            <input type="number" step="0.01" name="price" class="form-control" placeholder="Prix (€)" required>
        </div>

        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
</div>
@endsection
