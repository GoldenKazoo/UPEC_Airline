@extends('template')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Créer un compte</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="card p-4 shadow-sm mx-auto" style="max-width: 400px;">
        @csrf

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" placeholder="Votre nom" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Votre email" required>
        </div>

        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
        </div>

        <div class="mb-3">
            <label>Confirmation du mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmer mot de passe" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Créer mon compte</button>

        <div class="mt-3 text-center">
            <a href="{{ route('login') }}">Déjà inscrit ? Se connecter</a>
        </div>
    </form>
</div>
@endsection
