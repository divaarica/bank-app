<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use App\Models\Compte;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stringable;

class CarteBancaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Client.choisirCarte');
    }

    public function generer($choix)
    {
        $c = $choix;
        $user = auth()->user();
        $numero = Str::random(16, 'numeric');
        return view('Client.genererCarte', compact('c', 'numero', 'user'));
    }

    public function validerCarte(Request $request, $choix)
    {
        $request->validate([
            'cvv' => 'required|numeric|digits:3',
            'montant' => 'required|numeric|gt:0',
        ]);

        $numero = $request['numero'];
        $u = auth()->user();
        $montant = $request['montant'];
        $compteCourant = Compte::where('id_client', $u->id)->where('id_type', 1)->first();

        if ($compteCourant != null) {
            if ($montant > $compteCourant->balance) {

                return redirect()->route('client.genererCarte')->with('success', 'Vous ne disposer pas de ce montant dans votre compte');
            }



            $dateExpiration = Carbon::createFromDate($request['year'], $request['month'], 31);

            $carte = [
                'numero' => $numero,
                'id_client' => $u->id,
                'type' => $choix,
                'montant' => $montant,
                'cvv' => $request['cvv'],
                'date_expiration' => $dateExpiration,
            ];

            $compteCourant->decrement('balance', $montant);

            $c = Carte::create($carte);

            return redirect()->route('client.genererCarte', $choix)->with('success', 'Carte bien generer');
        }

        return redirect()->route('client.genererCarte')->with('success', 'Vous ne disposer pas de compte courant impossible de generer une carte');
    }

    public function mesCartes()
    {
        $u = auth()->user();
        $cartes = Carte::where('id_client', $u->id)->get();
        //dd($cartes);

        return view('Client.mesCartes', compact('cartes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        $carte = Carte::find($id);
        $compte = Compte::where('id_client', $carte -> client -> id)->where('id_type', 1)->first();
        $compte -> increment("balance", $carte->montant);
        $carte->delete();
        return redirect()->route('client.mesCartes')->with('success', 'Carte supprimer avec succès.');
    }
}
