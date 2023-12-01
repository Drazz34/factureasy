<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tableau de bord
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-2"><span class="font-bold">Nombre de clients :</span> {{$nombreDeClients}}</p>
                    <p class="mb-2"><span class="font-bold">Nombre total de factures :</span> {{$nombreDeFactures}}</p>
                    <p class="mb-2 pl-4"><span class="font-bold">Nombre de factures envoyées :</span> {{$nombreDeFacturesEnvoyees}}</p>
                    <p class="mb-2 pl-4"><span class="font-bold">Nombre de factures payées :</span> {{$nombreDeFacturesPayees}}</p>
                    <p class="mb-2 pl-4"><span class="font-bold">Nombre de factures en retard :</span> {{$nombreDeFacturesEnRetard}}</p>
                    <p class="mb-2"><span class="font-bold">Nombre d'adresses :</span> {{$nombreDAdresses}}</p>
                    <p class="mb-2"><span class="font-bold">Chiffre d'affaire réalisé :</span> {{$chiffreDAffaire}} €</p>
                    <p class="mb-2"><span class="font-bold">Chiffre d'affaire en retard :</span> {{$chiffreDAffaireEnRetard}} €</p>
                    <p class="mb-2"><span class="font-bold">Chiffre d'affaire à venir :</span> {{$chiffreDAffaireAVenir}} €</p>
                    <p class="mb-2"><span class="font-bold">Chiffre d'affaire potentiel total :</span> {{$chiffreDAffairePotentiel}} €</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>