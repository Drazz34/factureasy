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
                    @if($client->factures->isNotEmpty())
                    @foreach ($client->factures as $facture)
                    <div>
                        <p class="mb-2"><span class="font-bold">Numéro de Facture :</span> {{ $facture->id }}</p>
                        @if (\Carbon\Carbon::parse($facture->date_echeance)->isPast())
                        <p class="mb-2 text-red-600 font-bold">Attention : Cette facture est en retard !</p>
                        @endif
                        <p class="mb-2"><span class="font-bold">Facture envoyée :</span> {{ $facture->facture_envoyee ? 'Oui' : 'Non' }}</p>
                        <p class="mb-2"><span class="font-bold">Facture payée :</span> {{ $facture->facture_payee ? 'Oui' : 'Non' }}</p>
                    </div>
                    @endforeach
                    @else
                    <p class="mb-2 font-bold">Aucune facture associée</p>
                    @endif
                </div>
                <div class="px-6 py-4 flex flex-col md:flex-row justify-end space-y-3 md:space-y-0 md:space-x-3">
                    <x-edit-button :route-name="'clients.edit'" :item-id="$client->id" />
                    <x-delete-button :route-name="'clients.destroy'" :item-id="$client->id" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>