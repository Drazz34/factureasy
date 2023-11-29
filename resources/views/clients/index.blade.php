<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Liste de tous les clients
            </h2>
            <form action="{{ route('clients.search') }}" method="GET" class="flex items-center">
                <input type="text" name="recherche_nom" placeholder="Rechercher par nom..." class="mr-2 p-2 border rounded">
                <button type="submit" class="p-2 border rounded bg-gray-200 hover:bg-gray-300">Rechercher</button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex justify-center">
                    @if(count($clients) > 0)
                    <table class="leading-normal border-r border-l">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    ID
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider flex justify-between items-center">
                                    Actions
                                    <a href="{{route('clients.create')}}" class="btn btn-green">Créer</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{$client->id}}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{$client->nom}} {{$client->prenom}}
                                    @foreach ($client->factures as $facture)
                                    @if (\Carbon\Carbon::parse($facture->date_echeance)->isPast() && $facture->facture_payee == 0)
                                    <p class="mb-2 text-red-600 font-bold">facture en retard !</p>
                                    @endif
                                    @endforeach
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <x-show-button :route-name="'clients.show'" :item-id="$client->id" />
                                    <x-edit-button :route-name="'clients.edit'" :item-id="$client->id" />
                                    <x-delete-button :route-name="'clients.destroy'" :item-id="$client->id" />
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>Aucun client trouvé</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>