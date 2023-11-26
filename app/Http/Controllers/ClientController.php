<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Adresse;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::with('adresse')->get();
        return view('clients.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->validate([
            'nom' => 'required|string|max:45',
            'prenom' => 'required|string|max:45',
            'email' => 'required|string|max:45',
            'raison_sociale' => 'nullable|string|max:45',
            'telephone' => 'string|max:10',
            'numero_et_rue' => 'required|string|max:255',
            'code_postal' => 'required|string|max:5',
            'ville' => 'required|string|max:45',
            'facture_envoyee' => 'required',
            'facture_payee' => 'required'
        ])) {
            // Rechercher une adresse existante
            $adresse = Adresse::where('numero_et_rue', $request->input('numero_et_rue'))
                ->where('code_postal', $request->input('code_postal'))
                ->where('ville', $request->input('ville'))
                ->first();

            // Si l'adresse n'existe pas, créez-en une nouvelle
            if (!$adresse) {
                $adresse = new Adresse([
                    'numero_et_rue' => $request->input('numero_et_rue'),
                    'code_postal' => $request->input('code_postal'),
                    'ville' => $request->input('ville')
                ]);
                $adresse->save();
            }

            $client = new Client([
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'email' => $request->input('email'),
                'raison_sociale' => $request->input('raison_sociale', null),
                'telephone' => $request->input('telephone'),
                'facture_envoyee' => $request->input('facture_envoyee') === 'oui',
                'facture_payee' => $request->input('facture_payee') === 'oui',
                'adresse_id' => $adresse->id
            ]);
            $client->save();

            return redirect()->route("clients.show", $client->id);
        } else {
            return redirect()->back();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::with(['adresse', 'factures'])->findOrFail($id);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::find($id);
        return view('clients.edit',  [
            'id_client' => $id,
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->validate([
            'nom' => 'required|string|max:45',
            'prenom' => 'required|string|max:45',
            'email' => 'required|string|max:45',
            'raison_sociale' => 'nullable|string|max:45',
            'telephone' => 'required|string|max:10',
            'numero_et_rue' => 'required|string|max:255',
            'code_postal' => 'required|string|max:5',
            'ville' => 'required|string|max:45',
            'facture_envoyee' => 'required',
            'facture_payee' => 'required'
        ])) {
            $nom = $request->input('nom');
            $prenom = $request->input('prenom');
            $email = $request->input('email');
            $raison_sociale = $request->input('raison_sociale');
            $telephone = $request->input('telephone');
            $numero_et_rue = $request->input('numero_et_rue');
            $code_postal = $request->input('code_postal');
            $ville = $request->input('ville');
            // Convertir les valeurs en booléens
            $facture_envoyee = $request->input('facture_envoyee') === 'oui';
            $facture_payee = $request->input('facture_payee') === 'oui';

            $client = Client::with('adresse')->find($id);

            $client->update([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'raison_sociale' => $raison_sociale,
                'telephone' => $telephone,
                'facture_envoyee' => $facture_envoyee,
                'facture_payee' => $facture_payee
            ]);

            $adresseData = [
                'numero_et_rue' => $numero_et_rue,
                'code_postal' => $code_postal,
                'ville' => $ville
            ];

            if ($client->adresse) {
                // Vérifier si les détails de l'adresse ont changé
                if (
                    $client->adresse->numero_et_rue !== $numero_et_rue ||
                    $client->adresse->code_postal !== $code_postal ||
                    $client->adresse->ville !== $ville
                ) {
                    // Créer une nouvelle adresse si les détails ont changé
                    $nouvelleAdresse = new Adresse($adresseData);
                    $nouvelleAdresse->save();
                    $client->adresse_id = $nouvelleAdresse->id;
                    $client->save();
                }
            } else {
                // Créer une nouvelle adresse si le client n'en a pas
                $adresse = new Adresse($adresseData);
                $adresse->save();
                $client->adresse_id = $adresse->id;
                $client->save();
            }

            return redirect()->route("clients.show", $client->id);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('clients.index');
    }

    /**
     * Recherche des clients par nom dans la page index
     */
    public function search(Request $request)
    {
        $nom = $request->input('recherche_nom');
        $clients = Client::where('nom', 'like', "%$nom%")->get();

        return view('clients.index', compact('clients'));
    }
}
