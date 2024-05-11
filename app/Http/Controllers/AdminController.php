<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Packs;
use App\Models\Transaction;
use App\Models\TypeCompte;
use App\Models\Utilisateur;
use Carbon\Carbon;
use Dflydev\DotAccessData\Util;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nbClients = Utilisateur::Where('id_profil', 3)->count();
        $nbGuichetiers = Utilisateur::Where('id_profil', 2)->count();
        $nbComptes = Compte::Where('id','!=', 1)->count();
        $totalDepot = Transaction::Where('id_type', 2)->sum('montant');
        $totalRetrait = Transaction::Where('id_type', 3)->sum('montant');
        $totalTransfert = Transaction::Where('id_type', 1)->sum('montant');
        
        $trans = Transaction::Where('id_type', '!=', 4)->latest()->take(10)->get();

        $moisPrecedentPrecedent = Carbon::now()->subMonth(2)->month;
        $moisPrecedent = Carbon::now()->subMonth()->month;
        $ceMois = Carbon::now()->month;

        $gainAgios = Transaction::Where('id_type', 4)->sum('montant');
        $okAgio = Transaction::Where('id_type', 4)->whereMonth('created_at', $ceMois)->sum('montant');

        $transMoisPrecedentPrecedent = Transaction::whereMonth('created_at', $moisPrecedentPrecedent)->count();
        $transMoisPrecedent = Transaction::whereMonth('created_at', $moisPrecedent)->count();
        $transCeMois = Transaction::whereMonth('created_at', $ceMois)->count();

        
        return view('Admin.dashboard', compact('nbClients','nbGuichetiers', 'nbComptes','totalDepot', 'totalRetrait', 'gainAgios', 'trans','transMoisPrecedentPrecedent', 'transMoisPrecedent' ,'transCeMois', 'okAgio'  ));
        // return view('Client.dashboard');
    }

    public function createClient()
    {
        $types = Packs::all();
        return view('Admin.ajouterClient', compact('types'));
    }

    public function desactiverClient(string $id)
    {
        $comptes = Compte::Where('id_client', intval($id))->get();
        $user = Utilisateur::find($id);
        $user->state = 0;
        $user->save();
        foreach ($comptes as $compte) {
            $compte->state = 0;
            $compte->save();
        }

        
        return redirect()->route('admins.clients')->with('success', 'Client Desactiver avec succes.');
    }

    public function activerClient(string $id)
    {
        $comptes = Compte::Where('id_client', intval($id))->get();
        $user = Utilisateur::find($id);
        $user->state = 1;
        $user->save();
        foreach ($comptes as $compte) {
            $compte->state = 1;
            $compte->save();
        }

        
        return redirect()->route('admins.clients')->with('success', 'Client Activer avec succes.');
    }


    public function desactiverCompte(string $id)
    {
        $compte = Compte::find($id);
        $compte->state = 0;
        $compte->save();

        
        return redirect()->route('admins.comptes')->with('success', 'Compte Desactiver avec succes.');
    }

    public function activerCompte(string $id)
    {
        $compte = Compte::find($id);
        $compte->state = 1;
        $compte->save();
        
        return redirect()->route('admins.comptes')->with('success', 'Compte Activer avec succes.');
    }


    public function listeClients()
    {
        $clients = Utilisateur::Where('id_profil', 3)->get();
        return view('Admin.listeClients', compact('clients'));
    }

    public function listeComptes()
    {
        $comptes = Compte::Where('id','!=', 1)->get();
        $types = TypeCompte::all();
        $packs = Packs::all();
        return view('Admin.listeComptes', compact('comptes', 'types', 'packs'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.edit');
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
