@extends('template')

@section('title', 'Réservation')

@section('content')
<div class="container mt-5">
    <h2>Réserver le vol: {{ $vol->aeroportDepart->nom }} → {{ $vol->aeroportArrivee->nom }}</h2>
    <p>
        Départ : {{ \Carbon\Carbon::parse($vol->date_depart)->format('d/m/Y') }} à {{ $vol->heure_depart }}<br>
        Arrivée : {{ \Carbon\Carbon::parse($vol->date_arrivee)->format('d/m/Y') }} à {{ $vol->heure_arrivee }}
    </p>

    <form action="{{ route('reservation.create', ['volId' => $vol->id]) }}" method="GET" class="mb-3">
        <label for="nombre_passagers">Nombre de passagers</label>
        <input type="number" id="nombre_passagers" name="nombre_passagers" min="1" value="{{ old('nombre_passagers', $nombrePassagers ?? 1) }}" required>
        <button type="submit" class="btn btn-secondary">Mettre à jour</button>
    </form>

    <form action="{{ route('reservation.store') }}" method="POST" class="bg-light p-4 rounded">
        @csrf
        <input type="hidden" name="vol_id" value="{{ $vol->id }}">

        <div id="passengers">
            @for ($i = 0; $i < ($nombrePassagers ?? 1); $i++)
                <div class="passenger form-group mb-3">
                    <label for="prenom_{{ $i }}">Prénom</label>
                    <input type="text" class="form-control @error('prenom.' . $i) is-invalid @enderror" id="prenom_{{ $i }}" name="prenom[]" value="{{ old('prenom.' . $i) }}" required>
                    @error('prenom.' . $i)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <label for="nom_{{ $i }}" class="mt-2">Nom</label>
                    <input type="text" class="form-control @error('nom.' . $i) is-invalid @enderror" id="nom_{{ $i }}" name="nom[]" value="{{ old('nom.' . $i) }}" required>
                    @error('nom.' . $i)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endfor
        </div>

        <div class="form-group mb-3">
            <label for="email">Email (identique pour tous les passagers)</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Réserver</button>
    </form>
</div>
@endsection
