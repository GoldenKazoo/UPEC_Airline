@extends('template')

@section('title', 'Create account')

@section('content')
<div class="container">
<form action="{{ route('auth.register') }}" method="post">
    @csrf
    <h1>Créer un compte</h1>

    <div class="mb-4">
        <label>Nom</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-4">
        <label>Login (email)</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-4">
        <label>Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-4">
        <input type="submit" value="Créer le compte" class="btn btn-primary">
    </div>
</form>

@endsection