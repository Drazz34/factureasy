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
        return view('dashboard', compact('nombreDeClients', 'nombreDeFactures', 'nombreDeFacturesEnvoyees', 'nombreDeFacturesNonEnvoyees', 'nombreDeFacturesPayees', 'nombreDeFacturesNonPayees', 'nombreDeFacturesEnRetard', 'nombreDAdresses', 'chiffreDAffaire', 'chiffreDAffaireEnRetard', 'chiffreDAffaireAVenir', 'chiffreDAffairePotentiel'));
    }
}

