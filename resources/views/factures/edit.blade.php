<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier la facture n°{{$facture->id}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('factures.update', $facture->id)}}" method="POST" class="flex flex-col space-y-4">
                        @method('PUT')
                        @csrf
                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom du client* :</label>
                            <select name="client_id" id="nom" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm rounded-md">
                                @foreach($clients as $client)
                                <option value="{{$client->id}}" {{$facture->client_id == $client->id ? 'selected' : ''}}>
                                    {{$client->nom}} {{$client->prenom}}
                                </option>
                                @endforeach
                            </select>
                            @error('client_id')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="date_facture" class="block text-sm font-medium text-gray-700">Date de facturation* :</label>
                            <input type="date" name="date_facture" id="date_facture" value="{{$facture->date_facture}}" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('date_facture')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="date_echeance" class="block text-sm font-medium text-gray-700">Date d'échéance* :</label>
                            <input type="date" name="date_echeance" id="date_echeance" value="{{$facture->date_echeance}}" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('date_echeance')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="total_ht" class="block text-sm font-medium text-gray-700">Total HT* :</label>
                            <input type="text" name="total_ht" id="total_ht" value="{{$facture->total_ht}}" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('total_ht')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="total_ttc" class="block text-sm font-medium text-gray-700">Total TTC* :</label>
                            <input type="text" name="total_ttc" id="total_ttc" value="{{$facture->total_ttc}}" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('total_ttc')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="facture_envoyee" class="block text-sm font-medium text-gray-700">Facture envoyée :</label>
                            <select name="facture_envoyee" id="facture_envoyee" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm rounded-md">
                                <option value="1" {{ $facture->facture_envoyee == 1 ? 'selected' : '' }}>Oui</option>
                                <option value="0" {{ $facture->facture_envoyee == 0 ? 'selected' : '' }}>Non</option>
                            </select>
                            @error('facture_envoyee')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="facture_payee" class="block text-sm font-medium text-gray-700">Facture payée :</label>
                            <select name="facture_payee" id="facture_payee" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm rounded-md">
                                <option value="1" {{ $facture->facture_payee == 1 ? 'selected' : '' }}>Oui</option>
                                <option value="0" {{ $facture->facture_payee == 0 ? 'selected' : '' }}>Non</option>
                            </select>
                            @error('facture_payee')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-500 hover:bg-orange-600">
                            Valider
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>