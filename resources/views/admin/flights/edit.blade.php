@extends('template_admin')

@section('content')
<div class="container mt-4">
    <h1>Modifier Vol</h1>

    <form method="POST" action="{{ route('admin.flights.update', $flight->id) }}">
        @csrf

        <div class="mb-3">
            <input type="text" name="flight_number" class="form-control" value="{{ $flight->flight_number }}" required>
        </div>

        <div class="mb-3">
            <input type="number" name="departure_airport_id" class="form-control" value="{{ $flight->departure_airport_id }}" required>
        </div>

        <div class="mb-3">
            <input type="number" name="arrival_airport_id" class="form-control" value="{{ $flight->arrival_airport_id }}" required>
        </div>

        <div class="mb-3">
            <input type="datetime-local" name="departure_time" class="form-control" value="{{ \Carbon\Carbon::parse($flight->departure_time)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <input type="datetime-local" name="arrival_time" class="form-control" value="{{ \Carbon\Carbon::parse($flight->arrival_time)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <input type="number" name="seats_available" class="form-control" value="{{ $flight->seats_available }}" required>
        </div>

        <div class="mb-3">
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $flight->price }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
@endsection
