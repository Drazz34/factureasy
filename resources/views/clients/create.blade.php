<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un nouveau client
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('clients.store')}}" method="POST" class="flex flex-col space-y-4">
                        @csrf
                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom* :</label>
                            <input type="text" name="nom" id="nom" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('nom')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom* :</label>
                            <input type="text" name="prenom" id="prenom" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('prenom')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email* :</label>
                            <input type="email" name="email" id="email" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="raison_sociale" class="block text-sm font-medium text-gray-700">Raison sociale :</label>
                            <input type="text" name="raison_sociale" id="raison_sociale" class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone* :</label>
                            <input type="tel" name="telephone" id="telephone" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('telephone')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="numero_et_rue" class="block text-sm font-medium text-gray-700">Numéro et rue* :</label>
                            <input type="text" name="numero_et_rue" id="numero_et_rue" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('numero_et_rue')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="code_postal" class="block text-sm font-medium text-gray-700">Code postal* :</label>
                            <input type="text" name="code_postal" id="code_postal" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('code_postal')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="ville" class="block text-sm font-medium text-gray-700">Ville* :</label>
                            <input type="text" name="ville" id="ville" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('ville')
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