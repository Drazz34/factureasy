<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use App\Models\Client;
use App\Models\Facture;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $nombreDeClients = Client::count();
        $nombreDeFactures = Facture::count();
        $nombreDeFacturesEnvoyees = Facture::where('facture_envoyee', 1)->count();
        $nombreDeFacturesNonEnvoyees = Facture::where('facture_envoyee', 0)->count();
        $nombreDeFacturesPayees = Facture::where('facture_payee', 1)->count();
        $nombreDeFacturesNonPayees = Facture::where('facture_payee', 0)->count();
        $nombreDeFacturesEnRetard = Facture::where('date_echeance', '<', Carbon::now())
                                           ->where('facture_payee', 0)
                                           ->count();
        $nombreDAdresses = Adresse::count();
        $chiffreDAffaire = Facture::where('facture_payee', 1)->sum('total_ttc');
        $chiffreDAffaireEnRetard = Facture::where('date_echeance', '<', Carbon::now())->where('facture_payee', 0)->sum('total_ttc');
        $chiffreDAffaireAVenir = Facture::whereNot('date_echeance', '<', Carbon::now())->where('facture_payee', 0)->sum('total_ttc');
        $chiffreDAffairePotentiel = Facture::sum('total_ttc');

        $infosTableau = [
            ['label' => 'Nombre de clients', 'value' => $nombreDeClients],
            ['label' => 'Nombre total de factures', 'value' => $nombreDeFactures],
            ['label' => 'Nombre de factures envoyées', 'value' => $nombreDeFacturesEnvoyees],
            ['label' => 'Nombre de factures non envoyées', 'value' => $nombreDeFacturesNonEnvoyees],
            ['label' => 'Nombre de factures payées', 'value' => $nombreDeFacturesPayees],
            ['label' => 'Nombre de factures non payées', 'value' => $nombreDeFacturesNonPayees],
            ['label' => 'Nombre de factures en retard', 'value' => $nombreDeFacturesEnRetard],
            ['label' => 'Nombre d\'adresses', 'value' => $nombreDAdresses],
            ['label' => 'Chiffre d\'affaire réalisé', 'value' => $chiffreDAffaire, 'euro' => true, 'green' => true],
            ['label' => 'Chiffre d\'affaire en retard', 'value' => $chiffreDAffaireEnRetard, 'euro' => true, 'red' => true],
            ['label' => 'Chiffre d\'affaire à venir', 'value' => $chiffreDAffaireAVenir, 'euro' => true],
            ['label' => 'Chiffre d\'affaire potentiel total', 'value' => $chiffreDAffairePotentiel, 'euro' => true]
        ];

        return view('dashboard', compact('infosTableau'));
    }
}

