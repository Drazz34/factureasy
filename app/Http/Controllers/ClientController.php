<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Adresse;
use App\Models\Facture;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $clients = Client::with(['adresse', 'factures'])->get();
        $clients = Client::with(['adresse', 'factures'])->paginate(10);
        return view('clients.index', compact('clients'));
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
            'ville' => 'required|string|max:45'
        ])) {
            
            $adresse = Adresse::firstOrCreate([
                'numero_et_rue' => $request->input('numero_et_rue'),
                'code_postal' => $request->input('code_postal'),
                'ville' => $request->input('ville')
            ]);

            $client = new Client([
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'email' => $request->input('email'),
                'raison_sociale' => $request->input('raison_sociale', null),
                'telephone' => $request->input('telephone'),
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
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
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
            'ville' => 'required|string|max:45'
        ])) {
            $nom = $request->input('nom');
            $prenom = $request->input('prenom');
            $email = $request->input('email');
            $raison_sociale = $request->input('raison_sociale');
            $telephone = $request->input('telephone');
            $numero_et_rue = $request->input('numero_et_rue');
            $code_postal = $request->input('code_postal');
            $ville = $request->input('ville');

            $client = Client::with('adresse')->find($id);

            $client->update([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'raison_sociale' => $raison_sociale,
                'telephone' => $telephone
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
        $recherche = $request->input('recherche');
        $clients = Client::where('nom', 'like', "%$recherche%")->orWhere('email', 'like', "%$recherche%")->paginate(10);

        return view('clients.index', compact('clients'));
    }
}
