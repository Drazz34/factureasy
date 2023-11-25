<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier le client n°{{$client->id}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('clients.update', $client->id)}}" method="POST" class="flex flex-col space-y-4">
                        @method('PUT')
                        @csrf
                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom* :</label>
                            <input type="text" name="nom" id="nom" value="{{$client->nom}}" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('nom')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom* :</label>
                            <input type="text" name="prenom" id="prenom" value="{{$client->prenom}}" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('prenom')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror   
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email* :</label>
                            <input type="email" name="email" id="email" value="{{$client->email}}" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="raison_sociale" class="block text-sm font-medium text-gray-700">Raison sociale :</label>
                            <input type="text" name="raison_sociale" id="raison_sociale" value="{{$client->raison_sociale}}" class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone* :</label>
                            <input type="tel" name="telephone" id="telephone" value="{{$client->telephone}}" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="numero_et_rue" class="block text-sm font-medium text-gray-700">Numéro et rue* :</label>
                            <input type="text" name="numero_et_rue" id="numero_et_rue" value="{{$client->adresse->numero_et_rue}}" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="code_postal" class="block text-sm font-medium text-gray-700">Code postal* :</label>
                            <input type="text" name="code_postal" id="code_postal" value="{{$client->adresse->code_postal}}" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="ville" class="block text-sm font-medium text-gray-700">Ville* :</label>
                            <input type="text" name="ville" id="ville" value="{{$client->adresse->ville}}" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="facture_envoyee" class="block text-sm font-medium text-gray-700">Facture envoyée :</label>
                            <select name="facture_envoyee" id="facture_envoyee" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm rounded-md">
                                <option value="oui" @if($client->facture_envoyee)selected @endif>Oui</option>
                                <option value="non" @if(!$client->facture_envoyee)selected @endif>Non</option>
                            </select>
                        </div>
                        <div>
                            <label for="facture_payee" class="block text-sm font-medium text-gray-700">Facture payée :</label>
                            <select name="facture_payee" id="facture_payee" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm rounded-md">
                                <option value="oui" @if($client->facture_payee)selected @endif>Oui</option>
                                <option value="non" @if(!$client->facture_payee)selected @endif>Non</option>
                            </select>
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