<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facture;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factures = Facture::all();
        return view('factures.index', ['factures' => $factures]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('factures.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->validate([
            'date_facture' => 'required|date',
            'date_echeance' => 'required|date',
            'total_ht' => 'required|string',
            'total_ttc' => 'required|string',
            'facture_envoyee' => 'required',
            'facture_payee' => 'required'
        ])) {
            $facture = new Facture([
                'client_id' => $request->input('client_id'),
                'date_facture' => $request->input('date_facture'),
                'date_echeance' => $request->input('date_echeance'),
                'total_ht' => $request->input('total_ht'),
                'total_ttc' => $request->input('total_ttc'),
                'facture_envoyee' => $request->input('facture_envoyee'),
                'facture_payee' => $request->input('facture_payee')
            ]);
            $facture->save();

            return redirect()->route('factures.show', $facture->id);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $facture = Facture::with('client')->findOrFail($id);
        return view('factures.show', compact('facture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $facture = Facture::with('client')->findOrFail($id);
        $clients = Client::all();
        return view('factures.edit', compact('facture', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->validate([
            'date_facture' => 'required|date',
            'date_echeance' => 'required|date',
            'total_ht' => 'required|string',
            'total_ttc' => 'required|string',
            'facture_envoyee' => 'required',
            'facture_payee' => 'required'
        ])) {
            $client_id = $request->input('client_id');
            $date_facture = $request->input('date_facture');
            $date_echeance = $request->input('date_echeance');
            $total_ht = $request->input('total_ht');
            $total_ttc = $request->input('total_ttc');
            // Convertir les valeurs en booléens
            $facture_envoyee = $request->input('facture_envoyee') === '1';
            $facture_payee = $request->input('facture_payee') === '1';

            $facture = Facture::with('client')->find($id);

            $facture->update([
                'client_id' => $client_id,
                'date_facture' => $date_facture,
                'date_echeance' => $date_echeance,
                'total_ht' => $total_ht,
                'total_ttc' => $total_ttc,
                'facture_envoyee' => $facture_envoyee,
                'facture_payee' => $facture_payee
            ]);
            return redirect()->route('factures.show', $facture->id);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $facture = Facture::find($id);
        $facture->delete();
        return redirect()->route('factures.index');
    }
}
