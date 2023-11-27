<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détails de la facture n°{{$facture->id}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-bold text-lg mb-4">Facture de {{$facture->client->nom}} {{$facture->client->prenom}}</h2>
                    <p class="mb-2"><span class="font-bold">Date de facturation :</span> {{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') }}</p>
                    <p class="mb-2"><span class="font-bold">Date d'échéance :</span> {{ \Carbon\Carbon::parse($facture->date_echeance)->format('d/m/Y') }}</p>
                    <p class="mb-2"><span class="font-bold">Total HT :</span> {{$facture->total_ht}} €</p>
                    <p class="mb-2"><span class="font-bold">Total TTC :</span> {{$facture->total_ttc}} €</p>
                    <p class="mb-2"><span class="font-bold">Facture envoyée :</span> {{$facture->facture_envoyee ? 'Oui' : 'Non'}}</p>
                    <p class="mb-2"><span class="font-bold">Facture payée :</span> {{$facture->facture_payee ? 'Oui' : 'Non'}}</p>
                    @if (\Carbon\Carbon::parse($facture->date_echeance)->isPast())
                    <p class="mb-2 text-red-600 font-bold">Attention : Cette facture est en retard !</p>
                    @endif
                </div>
                <div class="px-6 py-4 flex flex-col md:flex-row justify-end space-y-3 md:space-y-0 md:space-x-3">
                    <x-edit-button :route-name="'factures.edit'" :item-id="$facture->id" />
                    <x-delete-button :route-name="'factures.destroy'" :item-id="$facture->id" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>