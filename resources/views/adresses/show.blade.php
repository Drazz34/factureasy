<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détails de l'adresse n°{{$adresse->id}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($adresse->clients->isNotEmpty())
                    @foreach($adresse->clients as $client)
                    <h2 class="font-bold text-lg mb-4">Adresse de : {{$client->nom}} {{$client->prenom}}</h2>
                    @endforeach
                    @else
                    <p class="mb-2 font-bold">Aucun client référencé à cette adresse</p>
                    @endif
                    <p class="mb-2"><span class="font-bold">Numéro et rue : </span> {{$adresse->numero_et_rue}}</p>
                    <p class="mb-2"><span class="font-bold">Code postal : </span> {{$adresse->code_postal}}</p>
                    <p class="mb-2"><span class="font-bold">Ville : </span> {{$adresse->ville}}</p>
                </div>
                <div class="px-6 py-4 flex flex-col md:flex-row justify-end space-y-3 md:space-y-0 md:space-x-3">
                    <x-edit-button :route-name="'adresses.edit'" :item-id="$adresse->id" />
                    <x-delete-button :route-name="'adresses.destroy'" :item-id="$adresse->id" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>