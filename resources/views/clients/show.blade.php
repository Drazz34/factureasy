@extends('layouts.template')

@section('titre', 'Détails d\'un client')

@section('contenu')

    <h1>Détails du client n°{{$client->id}}</h1>
    <h2>Nom : {{$client->nom}}</h2>
    <h2>Prénom : {{$client->prenom}}</h2>
    <div class="overflow-hidden
                shadow-sm
                rounded-lg
                bg-indigo-500
                hover:bg-cyan-600/50">
        <div class="p-5
                    text-white
                    text-center
                    md:text-left">
            Email : {{$client->email}}
        </div>
    </div>

@endsection