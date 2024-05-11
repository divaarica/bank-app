<?php

namespace App\Http\Controllers;

use App\Mail\mailCompteCourant;
use App\Mail\mailNouveauCompte;
use App\Models\Compte;
use App\Models\Packs;
use App\Models\Rib;
use App\Models\Transaction;
use App\Models\TypeCompte;
use App\Models\Utilisateur;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     */




    public function index()
    {
        $comptes = Compte::with('rib')->get();
        dd($comptes);
        $types = TypeCompte::all();
        $packs = Packs::all();
        return view('Admin.listeComptes', compact('comptes', 'types', 'packs'));
    }

    public function openClose()
    {
        //sous requete 
        //recupere les clients qui n'ont que 1 seule compte
        $clients = Utilisateur::where('id_profil', 3)
            ->has('comptes', '=', 1) // S'assurer que chaque utilisateur a un seul compte
            ->with('comptes')
            ->get();

        //dd($clients);
        return view('Admin.ouvrirCompte', compact('clients'));
    }

    public function openCompteCourant($idC, $idPack)
    {
        $u = Utilisateur::find($idC);
        $numeroCompte = Str::random(5) . $idC . Str::random(5);
        $compte = [
            'id_type' => 1,
            'id_pack' => $idPack,
            'id_client' => $idC,
            'numero' => $numeroCompte,
            'balance' => 0,
            'state' => 1,
        ];

        $c = Compte::create($compte);

        $iban = Str::random(25);
        $codeBanque = "14789";
        $bic = "BPLMF2K1";
        $codeGuichet = "1478";
        $clefRib = strval(rand(10, 99));

        $rib = [
            'codeBanque' => $codeBanque,
            'codeGuichet' => $codeGuichet,
            'cleRib' => $clefRib.$c -> id,
            'iban' => $iban,
            'bic' => $bic,
            'id_compte' => $c->id,
        ];

        Rib::create($rib);

        // Générer les données pour le PDF
        $dataRib = [
            'titulaire' => $u->prenom . ' ' . $u->nom,
            'iban' => $iban,
            'bic' => $bic,
            'code_agence' => $codeGuichet,
            'code_banque' => $codeBanque,
            'numero_compte' => $numeroCompte,
            'cle' => $clefRib.$c -> id,
        ];

        // Créer une instance de la classe PDF
        $pdf = app('dompdf.wrapper');

        // Charger la vue dans le PDF
        $pdf->loadView('Pdf.rib', $dataRib);

        $pdfData = $pdf->output();

        $compteInfo = [
            'numero' => $numeroCompte,
            'nom' => $u -> nom,
            'prenom' => $u -> prenom,
            'balance' => 0,
            'compte' => 'Courant',
            'Date' => (new DateTime())->format('Y-m-d H:i:s'),
        ];

        Mail::to($u -> email)->send(new mailNouveauCompte($compteInfo, $pdfData));
        return redirect()->route('comptes.openClose')->with('success', 'Compte creer avec succès.');


    }

    public function openCompteEpargne($idC, $idPack)
    {
        $u = Utilisateur::find($idC);
        $numeroCompte = Str::random(5) . $idC . Str::random(5);
        $compte = [
            'id_type' => 2,
            'id_pack' => $idPack,
            'id_client' => $idC,
            'numero' => $numeroCompte,
            'balance' => 0,
            'state' => 1,
        ];

        $c = Compte::create($compte);

        $iban = Str::random(25);
        $codeBanque = "14789";
        $bic = "BPLMF2K1";
        $codeGuichet = "1478";
        $clefRib = strval(rand(10, 99));

        $rib = [
            'codeBanque' => $codeBanque,
            'codeGuichet' => $codeGuichet,
            'cleRib' => $clefRib.$c -> id,
            'iban' => $iban,
            'bic' => $bic,
            'id_compte' => $c->id,
        ];

        Rib::create($rib);

        // Générer les données pour le PDF
        $dataRib = [
            'titulaire' => $u->prenom . ' ' . $u->nom,
            'iban' => $iban,
            'bic' => $bic,
            'code_agence' => $codeGuichet,
            'code_banque' => $codeBanque,
            'numero_compte' => $numeroCompte,
            'cle' =>$clefRib.$c -> id,
        ];

        // Créer une instance de la classe PDF
        $pdf = app('dompdf.wrapper');

        // Charger la vue dans le PDF
        $pdf->loadView('Pdf.rib', $dataRib);

        $pdfData = $pdf->output();

        $compteInfo = [
            'numero' => $numeroCompte,
            'nom' => $u -> nom,
            'prenom' => $u -> prenom,
            'balance' => 0,
            'compte' => 'Epargne',
            'Date' => (new DateTime())->format('Y-m-d H:i:s'),
        ];

        Mail::to($u -> email)->send(new mailNouveauCompte($compteInfo, $pdfData));
        return redirect()->route('comptes.openClose')->with('success', 'Compte creer avec succès.');


    }


    public function compteCourant()
    {
        $user = auth()->user();
        $compte = Compte::where('id_client', $user->id)->where('id_type', 1)->first();
        $ifCompte = ($compte != null) ? true : false;
        $trans = null;
        if($ifCompte){
            $trans = Transaction::where('id_compte_emetteur', $compte->id)
            ->orWhere('id_compte_destinataire', $compte->id)
            ->latest()
            ->get();
        }
        $types = TypeCompte::all();
        $packs = Packs::all();
        return view('Client.compteCourant', compact('ifCompte', 'compte', 'trans', 'types', 'packs'));
    }

    public function compteEpargne()
    {
        $user = auth()->user();
        $compte = Compte::where('id_client', $user->id)->where('id_type', 2)->first();
        $ifCompte = ($compte != null) ? true : false;
        $trans = null;
        if($ifCompte){
            $trans = Transaction::where('id_compte_emetteur', $compte->id)
            ->orWhere('id_compte_destinataire', $compte->id)
            ->latest()
            ->get();
        }
        $types = TypeCompte::all();
        $packs = Packs::all();
        return view('Client.compteEpargne', compact('ifCompte', 'compte', 'trans', 'types', 'packs'));
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
        $compte = Compte::find($id);

        $input = $request->all();


        $compte->update($input);

        return redirect()->back()->with('success', 'Compte modifier avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
