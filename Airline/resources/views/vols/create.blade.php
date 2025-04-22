@extends('template')
@section('content')
<div class="container">

    @if(session('success'))
        <h2 class="mb-4">Vol cree avec succes</h2>
    @endif

    <form action="{{ route('vols.store') }}" method="POST">
        @csrf
        <br>
        <h1>Créer un vol</h1>
        <div class="mb-3">
            <label>Numéro du vol</label>
            <input type="text" name="numero_vol" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Aéroport de départ</label>
            <select name="aeroport_depart_id" class="form-select" required>
                @foreach($aeroports as $aeroport)
                    <option value="{{ $aeroport->id }}">{{ $aeroport->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Aéroport d’arrivée</label>
            <select name="aeroport_arrivee_id" class="form-select" required>
                @foreach($aeroports as $aeroport)
                    <option value="{{ $aeroport->id }}">{{ $aeroport->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Date de départ</label>
                <input type="date" name="date_depart" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Heure de départ</label>
                <input type="time" name="heure_depart" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Date d’arrivée</label>
                <input type="date" name="date_arrivee" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Heure d’arrivée</label>
                <input type="time" name="heure_arrivee" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Nombre de places disponibles</label>
            <input type="number" name="places_disponibles" class="form-control" required min="1">
        </div>

        <div class="mb-3">
            <label>Prix (€)</label>
            <input type="number" name="prix" class="form-control" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer le vol</button>
    </form>
</div> 

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('addPassenger').addEventListener('click', function() {
        const passengersDiv = document.getElementById('passengers');
        const count = passengersDiv.children.length;
        const newPassenger = document.createElement('div');
        newPassenger.classList.add('passenger', 'form-group', 'mb-3');
        newPassenger.innerHTML = `
            <label for="prenom_${count}">Prénom</label>
            <input type="text" class="form-control" id="prenom_${count}" name="prenom[]" required>
            <label for="nom_${count}" class="mt-2">Nom</label>
            <input type="text" class="form-control" id="nom_${count}" name="nom[]" required>
        `;
        passengersDiv.appendChild(newPassenger);
    });
});
</script>
@endsection