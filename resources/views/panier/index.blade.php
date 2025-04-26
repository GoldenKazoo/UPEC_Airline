@extends('template_client')

@section('content')
<div class="container mt-4">
    <h1>Votre Panier</h1>

    @if(count($panier) > 0)
        <ul class="list-group mb-4">
            @foreach($panier as $flight)
                <li class="list-group-item">
                    <strong>{{ $flight['flight_number'] }}</strong> -
                    {{ $flight['departureAirport']['name'] }} → {{ $flight['arrivalAirport']['name'] }}
                    ({{ $flight['departure_time'] }})
                </li>
            @endforeach
        </ul>

        <form method="POST" action="{{ route('panier.confirm') }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="first_name" class="form-control" placeholder="Prénom" required>
            </div>
            <div class="mb-3">
                <input type="text" name="last_name" class="form-control" placeholder="Nom" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <input type="number" name="number_of_passengers" class="form-control" placeholder="Nombre de passagers" min="1" value="1" required>
            <br>
            <button type="submit" class="btn btn-primary">Confirmer l'achat</button>
            <div class="mb-3">
</div>

        </form>

    @else
        <p>Aucun vol dans votre panier.</p>
    @endif
</div>
@endsection
