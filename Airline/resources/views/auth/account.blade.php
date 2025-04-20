@extends('template')

@section('title', 'Private page')

@section('content')
<h1>FakeBank</h1>

@auth
Hi {{Auth::user()->name}}, 
welcome to your private account

<form action="{{route('auth.logout')}}" method="post">
@csrf

@method("delete")
<input type="submit" value="Logout">


</form>

@endauth

@endsection