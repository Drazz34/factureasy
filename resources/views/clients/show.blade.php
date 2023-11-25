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
                    <h2 class="font-bold text-lg mb-4">{{$client->nom}} {{$client->prenom}}</h2>
                    <p class="mb-2"><span class="font-bold">Raison sociale :</span> {{$client->raison_sociale ?: 'Aucune'}}</p>
                    <p class="mb-2"><span class="font-bold">Email :</span> {{$client->email}}</p>
                    <p class="mb-2"><span class="font-bold">Téléphone :</span> {{$client->telephone}}</p>
                    <p class="mb-2"><span class="font-bold">Numéro et rue : </span> {{$client->adresse->numero_et_rue}}</p>
                    <p class="mb-2"><span class="font-bold">Code postal : </span> {{$client->adresse->code_postal}}</p>
                    <p class="mb-2"><span class="font-bold">Ville : </span> {{$client->adresse->ville}}</p>
                    <p class="mb-2"><span class="font-bold">Facture envoyée :</span> {{$client->facture_envoyee ? 'Oui' : 'Non'}}</p>
                    <p class="mb-2"><span class="font-bold">Facture payée :</span> {{$client->facture_payee ? 'Oui' : 'Non'}}</p>
                </div>
                <div class="px-6 py-4 flex flex-col md:flex-row justify-end space-y-3 md:space-y-0 md:space-x-3">
                    <x-edit-button :client-id="$client->id" />
                    <x-delete-button :client-id="$client->id" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>