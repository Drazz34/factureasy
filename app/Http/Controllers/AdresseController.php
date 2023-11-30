<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use App\Models\Client;
use Illuminate\Http\Request;

class AdresseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adresses = Adresse::all();
        return view('adresses.index', ['adresses' => $adresses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adresses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->validate([
            'numero_et_rue' => 'required|string',
            'code_postal' => 'required|string',
            'ville' => 'required|string'
        ])) {

            $adresse = Adresse::firstOrCreate([
                'numero_et_rue' => $request->input('numero_et_rue'),
                'code_postal' => $request->input('code_postal'),
                'ville' => $request->input('ville')
            ]);
            
            return redirect()->route('adresses.show', $adresse->id);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $adresse = Adresse::with('clients')->findOrFail($id);
        return view('adresses.show', compact('adresse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $adresse = Adresse::find($id);
        return view('adresses.edit', ['adresse' => $adresse]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->validate([
            'numero_et_rue' => 'required|string',
            'code_postal' => 'required|string',
            'ville' => 'required|string'
        ])) {
            $numero_et_rue = $request->input('numero_et_rue');
            $code_postal = $request->input('code_postal');
            $ville = $request->input('ville');

            $adresse = Adresse::find($id);

            $adresse->update([
                'numero_et_rue' => $numero_et_rue,
                'code_postal' => $code_postal,
                'ville' => $ville
            ]);
            return redirect()->route('adresses.show', $adresse->id);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $adresse = Adresse::find($id);
        Client::where('adresse_id', $id)->update(['adresse_id' => null]);
        $adresse->delete();
        return redirect()->route('adresses.index');
    }
}
