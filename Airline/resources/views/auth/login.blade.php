@extends('template')

@section('title', 'Login page')

@section('content')
<div class="container">
    
<form action="{{route('auth.login')}}" method="post">
@csrf
<br>
<h1>Se connecter ?</h1>
    <div class="mb-4">
            <label>Login(email)</label>
            <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-4">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-4">
            <label></label>
            <input type="submit" value="Se connecter"><br>
    </div>

@error("invalid")
{{$message}}
@enderror

</form>

{{ session('success') }}
</div>
@endsection

