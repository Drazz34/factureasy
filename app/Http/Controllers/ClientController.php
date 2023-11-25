<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
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
            'raison_sociale' => 'string|max:45',
            'telephone' => 'string|max:10',
            'facture_envoyee' => 'boolean',
            'facture_payee' => 'boolean'
        ])) {
            $nom = $request->input('nom');
            $prenom = $request->input('prenom');
            $email = $request->input('email');
            $raison_sociale = $request->input('raison_sociale');
            $telephone = $request->input('telephone');
            $facture_envoyee = $request->input('facture_envoyee');
            $facture_payee = $request->input('facture_payee');

            $client = new Client();
            $client->nom = $nom;
            $client->prenom = $prenom;
            $client->email = $email;
            $client->raison_sociale = $raison_sociale;
            $client->telephone = $telephone;
            $client->facture_envoye = $facture_envoyee;
            $client->facture_payee = $facture_payee;

            $client->save();

            return redirect()->route("client.show");
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::find($id);
        return view('clients.show', [
            'id_client' => $id,
            'client' => $client
        ]);
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
            'raison_sociale' => 'string|max:45',
            'telephone' => 'string|max:10',
            'facture_envoyee' => 'required',
            'facture_payee' => 'required'
        ])) {
            $nom = $request->input('nom');
            $prenom = $request->input('prenom');
            $email = $request->input('email');
            $raison_sociale = $request->input('raison_sociale');
            $telephone = $request->input('telephone');
            // Convertir les valeurs en booléens
            $facture_envoyee = $request->input('facture_envoyee') === 'oui';
            $facture_payee = $request->input('facture_payee') === 'oui';

            $client = Client::find($id);

            $client->update([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'raison_sociale' => $raison_sociale,
                'telephone' => $telephone,
                'facture_envoyee' => $facture_envoyee,
                'facture_payee' => $facture_payee
            ]);

            return redirect()->route("clients.show", $client->id);
        } else {
            return redirect()->back();
        }
    }

    // public function update(Request $request, string $id)
    // {
    //     // Validation des données
    //     $validatedData = $request->validate([
    //         'nom' => 'required|string|max:45',
    //         'prenom' => 'required|string|max:45',
    //         'email' => 'required|string|max:45',
    //         'raison_sociale' => 'string|max:45',
    //         'telephone' => 'string|max:10',
    //         // Ici, nous validons simplement la présence des champs sans spécifier leur type
    //         'facture_envoyee' => 'required',
    //         'facture_payee' => 'required'
    //     ]);

    //     // Convertir "oui"/"non" en valeurs booléennes
    //     $facture_envoyee = $validatedData['facture_envoyee'] === 'oui';
    //     $facture_payee = $validatedData['facture_payee'] === 'oui';

    //     // Trouver le client par ID
    //     $client = Client::find($id);
    //     if (!$client) {
    //         // Gérer le cas où le client n'est pas trouvé
    //         return redirect()->back()->withErrors(['client_not_found' => 'Client introuvable.']);
    //     }

    //     // Mise à jour du client avec les données validées et les valeurs booléennes
    //     $client->update([
    //         'nom' => $validatedData['nom'],
    //         'prenom' => $validatedData['prenom'],
    //         'email' => $validatedData['email'],
    //         'raison_sociale' => $validatedData['raison_sociale'],
    //         'telephone' => $validatedData['telephone'],
    //         'facture_envoyee' => $facture_envoyee,
    //         'facture_payee' => $facture_payee
    //     ]);

    //     // Redirection vers la page du client
    //     return redirect()->route("clients.show", $client->id);
    // }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
