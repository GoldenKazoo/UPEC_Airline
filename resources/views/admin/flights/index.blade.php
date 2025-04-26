@extends('template_admin')

@section('content')
<div class="container mt-4">
    <h1>Information sur les vols</h1>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
    <thead>
    <tr>
        <th>Numéro</th>
        <th>Départ</th>
        <th>Arrivée</th>
        <th>Places restantes</th>
        <th>Passagers</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    @foreach($flights as $flight)
        <tr>
            <td>{{ $flight->flight_number }}</td>
            <td>{{ $flight->departure_airport_id }}</td>
            <td>{{ $flight->arrival_airport_id }}</td>
            <td>{{ $flight->seatsLeft() }}</td>
            <td>{{ $flight->numberOfPassengers() }}</td>
            <td>
                <a href="{{ route('admin.flights.edit', $flight->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('admin.flights.delete', $flight->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce vol ?')">Supprimer</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

    </table>
</div>
@endsection
