<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détails du client n°{{$client->id}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-bold">{{$client->nom}} {{$client->prenom}}</h2>
                    <p><span class="font-bold">Raison sociale :</span> {{$client->raison_sociale ?: 'Aucune'}}</p>
                    <p><span class="font-bold">Email :</span> {{$client->email}}</p>
                    <p><span class="font-bold">Téléphone :</span> {{$client->telephone}}</p>
                    <p><span class="font-bold">Facture envoyée :</span>
                        @if(!$client->facture_envoyee)
                        Non
                        @elseif($client->facture_envoyee)
                        Oui
                        @endif
                    </p>
                    <p><span class="font-bold">Facture payée :</span>
                        @if(!$client->facture_payee)
                        Non
                        @elseif($client->facture_payee)
                        Oui
                        @endif
                    </p>
                </div>
                <x-edit-button :client-id="$client->id" />
                <x-delete-button :client-id="$client->id" />
            </div>
        </div>
    </div>
</x-app-layout>