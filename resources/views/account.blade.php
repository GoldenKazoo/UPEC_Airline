@extends('template_admin')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Bienvenue {{ Auth::user()->name }}</h2>

    <div class="card p-4 shadow-sm mx-auto" style="max-width: 400px;">
        <p><strong>Email :</strong> {{ Auth::user()->email }}</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger w-100 mt-3">Se déconnecter</button>
        </form>
    </div>
</div>
@endsection
