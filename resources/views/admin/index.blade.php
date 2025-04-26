@extends('template_admin')

@section('content')
<div class="container mt-4">
    <h1>Tableau de bord Gestionnaire</h1>

    <div class="list-group mt-4">
        <a href="{{ route('admin.flights') }}" class="list-group-item list-group-item-action">Gérer les vols</a>
        <a href="{{ route('admin.reservations') }}" class="list-group-item list-group-item-action">Voir les réservations</a>
    </div>
</div>
@endsection
