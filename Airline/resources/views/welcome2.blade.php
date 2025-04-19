<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container mt-4">

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Numéro de vol</th>
            <th>Départ</th>
            <th>Arrivée</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vols as $vol)
            <tr>
                <td>{{ $vol->numero_vol }}</td>
                <td>{{ $vol->aeroportDepart->nom ?? 'N/A' }}</td>
                <td>{{ $vol->aeroportArrivee->nom ?? 'N/A' }}</td>
                <td>
                    <form action="{{ route('vols.destroy', $vol->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce vol ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
</body>
</html>