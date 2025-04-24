@extends('template')

@section('title', 'Réservation')

@section('content')
<div class="container mt-5">
    <h2>Réserver le vol: {{ $vol->aeroportDepart->nom }} → {{ $vol->aeroportArrivee->nom }}</h2>
    <p>
        Départ : {{ \Carbon\Carbon::parse($vol->date_depart)->format('d/m/Y') }} à {{ $vol->heure_depart }}<br>
        Arrivée : {{ \Carbon\Carbon::parse($vol->date_arrivee)->format('d/m/Y') }} à {{ $vol->heure_arrivee }}
    </p>


    {{-- Formulaire principal de réservation --}}
    <form action="{{ route('reservation.store') }}" method="POST" class="bg-light p-4 rounded">
        @csrf
        <input type="hidden" name="vol_id" value="{{ $vol->id }}">

        <div id="passengers">
            <div class="passenger form-group mb-3">
                <label for="prenom_0">Prénom</label>
                <input type="text" class="form-control @error('prenom.0') is-invalid @enderror" id="prenom_0" name="prenom[]" value="{{ old('prenom.0') }}" required>

                <label for="nom_0" class="mt-2">Nom</label>
                <input type="text" class="form-control @error('nom.0') is-invalid @enderror" id="nom_0" name="nom[]" value="{{ old('nom.0') }}" required>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email (identique pour tous les passagers)</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <button type="button" class="btn btn-secondary mb-3">Ajouter des passagers</button>
        <button type="submit" class="btn btn-primary">Réserver</button>
    </form>
</div>
@endsection
