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
                <select class="form-control" name="departure_airport" id="departure_airport" required>
                    <option value="">Sélectionnez un aéroport</option>
                    @foreach($aeroports as $aeroport)
                        <option value="{{ $aeroport->id }}" {{ request('departure_airport') == $aeroport->id ? 'selected' : '' }}>
                            {{ $aeroport->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="arrival_airport">Aéroport d'arrivée</label>
                <select class="form-control" name="arrival_airport" id="arrival_airport" required>
                    <option value="">Sélectionnez un aéroport</option>
                    @foreach($aeroports as $aeroport)
                        <option value="{{ $aeroport->id }}" {{ request('arrival_airport') == $aeroport->id ? 'selected' : '' }}>
                            {{ $aeroport->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="departure_date">Date de départ</label>
                <input type="date" class="form-control" name="departure_date" id="departure_date" value="{{ request('departure_date') }}">
            </div>
            <div class="col">
                <label for="arrival_date">Date d'arrivée</label>
                <input type="date" class="form-control" name="arrival_date" id="arrival_date" value="{{ request('arrival_date') }}">
            </div>
            <div class="col d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Rechercher</button>
            </div>
        </div>
    </form>

    {{-- Liste des vols --}}
    @if(isset($flights) && $flights->count() > 0 && request('departure_airport') && request('arrival_airport'))
        <div class="row">
            @foreach($flights as $flight)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $flight->aeroportDepart->nom }} → {{ $flight->aeroportArrivee->nom }}</h5>
                            <p class="card-text">
                                Départ : {{ \Carbon\Carbon::parse($flight->date_depart->format('Y-m-d') . ' ' . \Carbon\Carbon::parse($flight->heure_depart)->format('H:i:s'))->format('d/m/Y H:i') }}<br>
                                Arrivée : {{ \Carbon\Carbon::parse($flight->date_arrivee->format('Y-m-d') . ' ' . \Carbon\Carbon::parse($flight->heure_arrivee)->format('H:i:s'))->format('d/m/Y H:i') }}<br>
                                Prix : {{ $flight->prix }} €
                            </p>
                            <a href="{{ route('reservation.create', ['volId' => $flight->id]) }}" class="btn btn-success">Réserver</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif(isset($flights) && (request('departure_airport') || request('arrival_airport')))
        <div class="alert alert-warning">Aucun vol trouvé selon vos critères de recherche.</div>
    @endif
</div>

@endsection
