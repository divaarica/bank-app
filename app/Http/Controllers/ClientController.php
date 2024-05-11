<?php

namespace App\Http\Controllers;

use App\Mail\mailNouveauCompte;
use App\Mail\mailSimple;
use App\Mail\MonMail;
use App\Models\Compte;
use App\Models\Packs;
use App\Models\Rib;
use App\Models\Transaction;
use App\Models\TypeCompte;
use App\Models\User;
use App\Models\Utilisateur;
use Barryvdh\DomPDF\PDF as PDF;
use DateTime;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        return view('Client.edit', compact('user'));
    }

    public function choixCarte()
    {
        return view('Client.choisirCarte');
    }

    public function mesCartes()
    {
        return view('Client.mesCartes');
    }

    public function showc()
    {
        return view('Client.edit');
    }

    public function mesTransactions()
    {
        $trans = Transaction::where();
        return view('Client.mesTransactions', compact('trans'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Packs::all();
        return view('Admin.ajouterClient', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "nom" => "required",
                "prenom" => "required",
                "adresse" => "required",
                "tel" => "required|numeric",
                "email" => "required|email",
                "numeroCI" => "required",

            ]
        );



        $iban = Str::random(25);
        $codeBanque = "14789";
        $bic = "BPLMF2K1";
        $codeGuichet = "1478";
        $clefRib = strval(rand(10, 99));

        $password = Str::random(5);

        $str = Str::random(2);
        $input = array_merge([
            'numero' => 'Client-' . $str . $request->input('numeroCI'),
            'password' => Hash::make($password),
            'id_profil' => 3,
            'authentification' => 0,
            'state' => 1,
        ], $request->all());


        $request['pass'] = $password;

        //dd($input);
        $u = Utilisateur::create($input);


        if ($input['id_type'] == "1" || $input['id_type'] == "2") {
            $numeroCompte = Str::random(5) . $u->id . Str::random(5);
            $compte = [
                'id_type' => intval($input['id_type']),
                'id_pack' => intval($input['id_pack']),
                'id_client' => $u->id,
                'numero' => $numeroCompte,
                'balance' => 0,
                'state' => 1,
            ];


            // on creer le compte puis le rib

            $c = Compte::create($compte);

            $rib = [
                'codeBanque' => $codeBanque,
                'codeGuichet' => $codeGuichet,
                'cleRib' =>  $clefRib.$c -> id,
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
                'cle' =>  $clefRib.$c -> id,
            ];

            $compteInfo = [
                'numero' => $numeroCompte,
                'nom' => $u -> nom,
                'prenom' => $u -> prenom,
                'balance' => 0,
                'compte' => $c-> type -> libelle,
                'Date' => $c -> created_at,
            ];


            // Créer une instance de la classe PDF
            $pdf = app('dompdf.wrapper');

            // Charger la vue dans le PDF
            $pdf->loadView('Pdf.rib', $dataRib);

            $pdfData = $pdf->output();

            //on envoie unn mil de confimation de creation de compte
            Mail::to($input['email'])->send(new mailSimple($request));

            //on envoie un mail pour la creation du compte et le rib associe
            Mail::to($input['email'])->send(new mailNouveauCompte($compteInfo, $pdfData));

        } else {

            $numeroCompte1 = Str::random(10) . $u->id;
            $compte1 = [
                'id_type' => 1,
                'id_pack' => intval($input['id_pack']),
                'id_client' => $u->id,
                'numero' => $numeroCompte1,
                'balance' => 0,
                'state' => 1,
            ];
            $c1 = Compte::create($compte1);

            $rib1 = [
                'codeBanque' => $codeBanque,
                'codeGuichet' => $codeGuichet,
                'cleRib' => $clefRib.$c1->id,
                'iban' => $iban,
                'bic' => $bic,
                'id_compte' => $c1->id,
            ];

            $r1 = Rib::create($rib1);

            $dataRib1 = [
                'titulaire' => $u->prenom . ' ' . $u->nom,
                'iban' => $iban,
                'bic' => $bic,
                'code_agence' => $codeGuichet,
                'code_banque' => $codeBanque,
                'numero_compte' => $numeroCompte1,
                'cle' => $clefRib.$c1->id,
            ];


            $numeroCompte2 = $u->id . Str::random(10);
            $compte2 = [
                'id_type' => 2,
                'id_pack' => intval($input['id_pack']),
                'id_client' => $u->id,
                'numero' => $numeroCompte2,
                'balance' => 0,
                'state' => 1,
            ];
            $c2 = Compte::create($compte2);


            $rib2 = [
                'codeBanque' => $codeBanque,
                'codeGuichet' => $codeGuichet,
                'cleRib' => $clefRib.$c2->id,
                'iban' => $iban,
                'bic' => $bic,
                'id_compte' => $c2->id,
            ];

            $dataRib2 = [
                'titulaire' => $u->prenom . ' ' . $u->nom,
                'iban' => $iban,
                'bic' => $bic,
                'code_agence' => $codeGuichet,
                'code_banque' => $codeBanque,
                'numero_compte' => $numeroCompte2,
                'cle' =>  $clefRib.$c2->id,
            ];

            $r2 = Rib::create($rib2);

            $compteInfo1 = [
                'numero' => $numeroCompte1,
                'nom' => $u -> nom,
                'prenom' => $u -> prenom,
                'balance' => 0,
                'compte' => $c1-> type -> libelle,
                'Date' => $c1 -> created_at,
            ];

            $compteInfo2 = [
                'numero' => $numeroCompte2,
                'nom' => $u -> nom,
                'prenom' => $u -> prenom,
                'balance' => 0,
                'compte' => $c2-> type -> libelle,
                'Date' => $c2 -> created_at,
            ];

            $pdf1 = app('dompdf.wrapper');
            $pdf1->loadView('Pdf.rib', $dataRib1);
            $pdfData1 = $pdf1->output();

            $pdf2 = app('dompdf.wrapper');
            $pdf2->loadView('Pdf.rib', $dataRib2);
            $pdfData2 = $pdf2->output();

            //on envoie unn mail de confimation de creation de compte
            Mail::to($input['email'])->send(new mailSimple($request));

            //on envoie un mail pour la creation du compte et le rib associe
            Mail::to($input['email'])->send(new mailNouveauCompte($compteInfo1, $pdfData1));
            Mail::to($input['email'])->send(new mailNouveauCompte($compteInfo2, $pdfData2));
        }

        return redirect()->back()->with('flash_message', 'Client et compte(s) creer avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('Client.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Utilisateur::find($id);
        $request->validate(
            [
                "nom" => "required",
                "prenom" => "required",
                "adresse" => "required",
                "tel" => "required|numeric",
                "email" => "required|email",
                "numeroCI" => "required",

            ]
        );

        $input = $request->all();
        $client->update($input);

        return redirect()->route('admins.clients')->with('success', 'Client modifier avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Transaction::where('id_emetteur', intval($id))
            ->orWhere('id_destinataire', intval($id))
            ->delete();

        $comptes = Compte::Where('id_client', intval($id))->get();
        foreach ($comptes as $compte) {
            Rib::Where('id_compte', $compte->id)->delete();
        }

        Compte::Where('id_client', intval($id))->delete();
        $user = Utilisateur::find($id);
        $user->delete();
        return redirect()->route('admins.clients')->with('success', 'Client supprimer avec succes.');
    }

    



    public function genererPDF()
    {
    }
}
