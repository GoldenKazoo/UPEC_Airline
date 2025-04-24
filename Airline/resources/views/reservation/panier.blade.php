@extends('template')

@section('title', 'Panier')

@section('content')
<div class="container mt-5">
    <h2>Votre panier</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($flights) > 0)
        <form action="{{ route('panier.confirm') }}" method="POST">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th>Vol</th>
                        <th>Passagers</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flights as $index => $item)
                        <tr>
                            <td>
                                {{ $item['vol']->aeroportDepart->nom }} → {{ $item['vol']->aeroportArrivee->nom }}<br>
                                Départ : {{ \Carbon\Carbon::parse($item['vol']->date_depart->format('Y-m-d') . ' ' . \Carbon\Carbon::parse($item['vol']->heure_depart)->format('H:i:s'))->format('d/m/Y H:i') }}<br>
                                Arrivée : {{ \Carbon\Carbon::parse($item['vol']->date_arrivee->format('Y-m-d') . ' ' . \Carbon\Carbon::parse($item['vol']->heure_arrivee)->format('H:i:s'))->format('d/m/Y H:i') }}<br>
                                Prix : {{ number_format($item['vol']->prix, 2, ',', ' ') }} €

                            </td>
                            <td>
                                <ul>
                                    @for ($i = 0; $i < count($item['prenoms']); $i++)
                                        <li>{{ $item['prenoms'][$i] }} {{ $item['noms'][$i] }}</li>
                                    @endfor
                                </ul>
                            </td>
                            <td>{{ $item['email'] }}</td>
                            <td>
                                <a href="{{ route('panier.remove', ['index' => $index]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce vol du panier ?')">Supprimer</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Confirmer l'achat</button>
        </form>

    @else
        <p>Votre panier est vide.</p>
    @endif
</div>

<div style="position: fixed; bottom: 20px; left: 50%;">
    <a href="{{ route('ticket.showFly') }}" class="btn btn-secondary">Retour à la billetterie</a>
</div>
@endsection
