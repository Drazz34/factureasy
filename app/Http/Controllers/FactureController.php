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
        return view('factures.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
