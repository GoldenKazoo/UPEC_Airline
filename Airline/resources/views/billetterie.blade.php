@extends("template")
@section('title', 'Billetterie')
@section("content")

<div class="container mt-5">
    <h2 class="text-center text-white mb-4">Achetez vos billets d'avion</h2>

    {{-- Formulaire de filtrage --}}
    
    <form action="{{ route('ticket.showFly') }}" method="GET" class="bg-light p-4 rounded mb-4">
        <div class="form-row">
            <div class="col">
                <label for="departure_airport">Aéroport de départ</label>
                <input type="text" class="form-control" name="departure_airport" id="departure_airport" placeholder="Ex : Paris-CDG">
            </div>
            <div class="col">
                <label for="arrival_airport">Aéroport d'arrivée</label>
                <input type="text" class="form-control" name="arrival_airport" id="arrival_airport" placeholder="Ex : New York-JFK">
            </div>
            <div class="col">
                <label for="departure_date">Date de départ</label>
                <input type="date" class="form-control" name="departure_date" id="departure_date">
            </div>
            <div class="col">
                <label for="arrival_date">Date d'arrivée</label>
                <input type="date" class="form-control" name="arrival_date" id="arrival_date">
            </div>
            <div class="col d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Rechercher</button>
            </div>
        </div>
    </form>

    {{-- Liste des vols --}}
    @if(isset($flights) && $flights->count() > 0)
        <div class="row">
            @foreach($flights as $flight)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $flight->departure_airport }} → {{ $flight->arrival_airport }}</h5>
                            <p class="card-text">
                                Départ : {{ \Carbon\Carbon::parse($flight->departure_date)->format('d/m/Y H:i') }}<br>
                                Arrivée : {{ \Carbon\Carbon::parse($flight->arrival_date)->format('d/m/Y H:i') }}<br>
                                Prix : {{ $flight->price }} €
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif(isset($flights))
        <div class="alert alert-warning">Aucun vol trouvé selon vos critères de recherche.</div>
    @endif
</div>

@endsection
