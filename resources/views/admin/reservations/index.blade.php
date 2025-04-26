@extends('template_admin')

@section('content')
<div class="container mt-4">
    <h1>Réservations Clients</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom Client</th>
                <th>Email</th>
                <th>Vol</th>
                <th>Date Réservation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
                    <td>{{ $reservation->email }}</td>
                    <td>{{ $reservation->flight->flight_number }}</td>
                    <td>{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
