<?php

namespace App\Http\Controllers;

use App\Mail\mailAgio;
use App\Mail\mailExcuseAgio;
use App\Mail\mailInfo;
use App\Mail\mailRollbackAgence;
use App\Mail\mailRollbackClient;
use App\Mail\MailTransaction;
use App\Mail\MailTransactionE;
use App\Mail\MailTransactionR;
use App\Models\Compte;
use App\Models\Rib;
use App\Models\Transaction;
use App\Models\TypeTransaction;
use App\Models\Utilisateur;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.listeTransactions');
    }


    public function receVoirInfo(Request $request)
    {
        $request->validate(
            [
                "email" => "required",
                "codeTrans" => "required",
                "motDePasse" => "required",

            ]

        );

        $email = $request['email'];
        $codeTrans = $request['codeTrans'];
        $motDePasse = $request['motDePasse'];
        
        if(Auth::attempt(['email' => $email, 'password' => $motDePasse])){

            $client = Utilisateur::where('email', $email)->first();
            $trans = Transaction::where('id_emetteur', $client->id)->orWhere('id_destinataire', $client->id)->where('code', $codeTrans)->first();
            if ($trans != null) {
    
                if ($trans->id_type == 1) {


                    $input = [
                        'prenom1' => $trans->compte_emetteur->client->prenom,
                        'nom1' => $trans->compte_emetteur->client->nom,
                        'prenom2' => $trans->compte_recepteur->client->prenom,
                        'nom2' => $trans->compte_recepteur->client->nom,
                        'type' => 1,
                        'montant' => $trans->montant,
                        'Date' => $trans->created_at,
                        'email' => $client->email,
                    ];


                    Mail::to($input['email'])->send(new mailInfo($input));
                    return redirect()->back()->with('success', 'L\' email a bien ete envoyer a votre adresse');
                   

                } elseif ($trans->id_type == 2) {
                    $input = [
                        'prenom' => $trans->compte_recepteur->client->prenom,
                        'nom' => $trans->compte_recepteur->client->prenom,
                        'type' => 2,
                        'montant' => $trans->montant,
                        'Date' => $trans->created_at,
                        'email' => $client->email,
                    ];


                    Mail::to($input['email'])->send(new mailInfo($input));
                    return redirect()->back()->with('success', 'L\' email a bien ete envoyer a votre adresse');
                    
                } else {
                    $input = [
                        'prenom' => $trans->compte_recepteur->client->prenom,
                        'nom' => $trans->compte_recepteur->client->prenom,
                        'type' => 3,
                        'montant' => $trans->montant,
                        'Date' => $trans->created_at,
                        'email' => $client->email,
                    ];

                    Mail::to($input['email'])->send(new mailInfo($input));

                    return redirect()->back()->with('success', 'L\' email a bien ete envoyer a votre adresse');
                    
                }
            }

            return redirect()->back()>with('success', 'Transaction ou email introuvable');



        }


        return redirect()->back()->with('success', 'Transaction ou email introuvable');
    }


    public function listeTransactions()
    {
        $trans = Transaction::all();
        return view('Admin.listeTransactions', compact('trans'));
    }


    public function choixTransfert()
    {

        return view('Client.choixTransfert');
    }

    public function ValidertransfertMemeBanque(Request $request)
    {
        $request->validate(
            [
                "account_number" => "required",

            ]
        );



        //dd($request['account_number']);
        $numCompte = $request['account_number'];
        $compte = Compte::where('numero', $numCompte)->first();
        $ifCompte = ($compte != null) ? true : false;
        if (!$ifCompte) {

            return redirect()->route('transactions.memeBanque')->with('success', 'Compte introuvables.');
        }

        $client1 = auth()->user();
        $client2 = Utilisateur::find($compte->client->id);
        $compte1 = Compte::where('id_type', 1)->where('id_client', $client1->id)->first();
        $compte2 = $compte;

        $codeTrans = Str::random(15) . $client1->id . $client2->id;

        // enelevr le fait le clients peut etre un compte epargne aussi

        return view('Client.Transfert', compact('codeTrans', 'client1', 'client2', 'compte1', 'compte2'));
    }

    public function ValidertransfertBanqueDifferente(Request $request)
    {
        $request->validate(
            [
                "iban" => "required",
                "bic" => "required",
                "numero" => "required",
                "cle" => "required",

            ]

        );

        //dd($request['account_number']);
        $numCompte = $request['numero'];
        $cle = $request['cle'];
        $iban = $request['iban'];
        $bic = $request['bic'];
        $compte = Compte::where('numero', $numCompte)->first();
        $ifCompte = ($compte != null) ? true : false;
        if (!$ifCompte) {

            return redirect()->route('transactions.banqueDifferente')->with('success', 'Compte introuvables.');
        } else {

            $rib = Rib::where('cleRib', $cle)->where('bic', $bic)->where('iban', $iban)->where('id_compte', $compte->id)->first();
            $ifRib = ($rib != null) ? true : false;
            if (!$ifRib) {

                return redirect()->route('transactions.banqueDifferente')->with('success', 'Compte introuvables.');
            }
        }

        $client1 = auth()->user();
        $client2 = Utilisateur::find($compte->client->id);
        $compte1 = Compte::where('id_type', 1)->where('id_client', $client1->id)->first();
        $compte2 = $compte;

        $codeTrans = Str::random(15) . $client1->id . $client2->id;


        return view('Client.Transfert', compact('codeTrans', 'client1', 'client2', 'compte1', 'compte2'));
    }

    public function dotransfertClient(Request $request, $clt1, $clt2, $cpt1, $cpt2)
    {
        $request->validate([
            'montantDepot' => 'required|numeric|gt:0',
        ]);

        $montantDepot = $request->input('montantDepot');
        $client1 = Utilisateur::find($clt1);
        $client2 = Utilisateur::find($clt2);
        $compte1 = Compte::find($cpt1);
        $compte2 = Compte::find($cpt2);
        $plafondClt2 = $compte2->pack->plafond;
        $plafondClt1 = $compte1->pack->plafond;


        $ceMois = Carbon::now()->month;
        $somme1 = Transaction::where('id_compte_destinataire', $compte1->id)->orWhere('id_compte_emetteur', $compte1->id)->whereMonth('created_at', $ceMois)->sum('montant');

        $somme2 = Transaction::where('id_compte_destinataire', $compte2->id)->orWhere('id_compte_emetteur', $compte2->id)->whereMonth('created_at', $ceMois)->sum('montant');



        if ($plafondClt1 != 0 || $plafondClt2 != 0) { //sa veut dire que le compte n'est pas illimite


            if ($compte1->balance < $montantDepot) {
                return redirect()->back()->with('success', 'Votre compte n\' a pas assez de balance pour effectuer ce transfert ');
            } elseif ($montantDepot > $plafondClt1 && $plafondClt1 != 0) {

                return redirect()->back()->with('success', 'impossible d\'effectuer la transaction car le montant depasse le plafond de votre compte  ');
            } elseif ($somme1 >= $plafondClt1 && $plafondClt1 != 0) {

                return redirect()->back()->with('success', 'votre compte  a atteint son plafond impossible d\'effectuer une autre transaction ');
            } elseif ($somme1 + $montantDepot > $plafondClt1 && $plafondClt1 != 0) {

                return redirect()->back()->with('success', 'impossible de faire une transaction avec une telle somme car avec cette somme le plafond de l\'emmeteur sera depasser ');
            } elseif ($montantDepot > $plafondClt2 && $plafondClt2 != 0) { //destinataire

                return redirect()->back()->with('success', 'impossible d\'effectuer la transaction car le montant depasse le plafond du compte destinataire  ');
            } elseif ($somme2 >= $plafondClt2 && $plafondClt2 != 0) {

                return redirect()->back()->with('success', 'le compte du destinataire  a atteint son plafond impossible d\'effectuer une autre transaction ');
            } elseif ($somme2 + $montantDepot > $plafondClt2 && $plafondClt2 != 0) {

                return redirect()->back()->with('success', 'impossible de faire une transaction avec une telle somme car avec cette somme le plafond du destintaire sera depasser ');
            } else {
                $compte1->decrement('balance', $montantDepot);
                $compte2->increment('balance', $montantDepot);
            }
        } else {
            // dd($montantDepot);
            $compte1->decrement('balance', $montantDepot);
            $compte2->increment('balance', $montantDepot);
            // dd($compte1->balance);
        }



        $codeTrans = $request->input('codeTransaction');
        $transaction = [
            'code' => $codeTrans,
            'id_compte_emetteur' => $compte1->id,
            'id_compte_destinataire' => $compte2->id,
            'id_emetteur' => $client1->id,
            'id_destinataire' => $client2->id,
            'montant' => $montantDepot,
            'id_type' => 1, //type transfert
        ];

        $t = Transaction::create($transaction);


        $input1 = [
            'prenom' => $client1->prenom,
            'nom' => $client1->nom,
            'prenom2' => $client2->prenom,
            'nom2' => $client2->nom,
            'code' => $codeTrans,
            'dire' => 'Vous avez transferer',
            'dire2' => 'a',
            'type' => 'Transfert',
            'montant' => $montantDepot,
            'compte' => $compte1->numero,
            'compte2' => $compte1->numero,
            'Date' => $t->created_at,
            'email' => $client1->email,
            'balance' => $compte1->balance,
        ];

        $input2 = [
            'prenom' => $client2->prenom,
            'nom' => $client2->nom,
            'prenom2' => $client1->prenom,
            'nom2' => $client1->nom,
            'code' => $codeTrans,
            'dire' => 'Vous avez recu',
            'dire2' => 'de',
            'type' => 'Transfert',
            'montant' => $montantDepot,
            'compte' => $compte1->numero,
            'compte2' => $compte1->numero,
            'Date' => $t->created_at,
            'email' => $client2->email,
            'balance' => $compte2->balance,
        ];

        Mail::to($input1['email'])->send(new MailTransactionE($input1));
        Mail::to($input2['email'])->send(new MailTransactionR($input2));

        return redirect()->route('transactions.choixTransfert')->with('success', 'Transaction Bien effectuer');
    }



    public function transfertMemeBanque()
    {

        return view('Client.tranfertMemeBanque');
    }



    public function transfertBanqueDifferente()
    {

        return view('Client.transfertBanqueDifferente');
    }

    public function transfertCompteEpargne()
    {
        $user = auth()->user();
        $compteCourant = Compte::where('id_client', $user->id)->where('id_type', 1)->first();
        $ifCompteCourant = ($compteCourant != null) ? true : false;
        $compteEpargne = Compte::where('id_client', $user->id)->where('id_type', 2)->first();
        $ifCompteEpargne = ($compteEpargne != null) ? true : false;
        return view('Client.transfertCompteEpargne', compact('ifCompteCourant', 'ifCompteEpargne', 'compteEpargne', 'compteCourant'));
    }

    public function doTransfertEpargne(Request $request, $compteEpargne, $compteCourant)
    {

        $request->validate([
            'montantDepot' => 'required|numeric|gt:0',
        ]);


        $compteCourantt = Compte::where('id', $compteCourant)->first();
        $compteEpargnee = Compte::where('id', $compteEpargne)->first();
        $balance1 = $compteCourantt->balance;
        $user = auth()->user();
        $codeTrans = Str::random(15) . $compteEpargne;
        $montantDepot = $request['montantDepot'];



        if ($balance1 < $montantDepot) {

            return redirect()->back()->with('success', 'impossible d\'effectuer la transaction car la balance de votre compte courant est insuffisante  ');
        }



        $compteEpargnee->increment('balance', $montantDepot);
        $compteCourantt->decrement('balance', $montantDepot);

        $transaction = [
            'code' => $codeTrans,
            'id_compte_emetteur' => $compteCourantt->id,
            'id_compte_destinataire' => $compteEpargnee->id,
            'id_emetteur' => $user->id,
            'id_destinataire' => $user->id,
            'montant' => $montantDepot,
            'id_type' => 1, //type transfert
        ];

        $t = Transaction::create($transaction);

        $input = [
            'prenom' => $user->prenom,
            'nom' => $user->nom,
            'prenom2' => $user->prenom,
            'nom2' => $user->nom,
            'code' => $codeTrans,
            'dire' => 'Vous avez recu',
            'dire2' => 'de',
            'type' => 'Transfert',
            'montant' => $montantDepot,
            'compte' => $compteEpargnee->numero,
            'compte2' => $compteCourantt->numero,
            'Date' => $t->created_at,
            'email' => $user->email,
            'balance' => $compteCourantt->balance,
        ];

        Mail::to($input['email'])->send(new MailTransactionE($input));


        return redirect()->back()->with('success', 'Transfert bien effectuer  ');
    }



    public function retraitClient()
    {

        return view('Client.retrait');
    }

    public function transfertClient()
    {

        return view('Client.retrait');
    }



    //Admin

    public function depotRetrait()
    {
        $comptes = Compte::where('id_client', '!=', 1)->get();
        return view('Admin.faireDepotRetrait', compact('comptes'));
    }

    public function depot($compte)
    {
        $cpt = Compte::find($compte);
        $codeTrans = Str::random(15) . $cpt->id;
        return view('Admin.depot', compact('cpt', 'codeTrans'));
    }

    public function doDepot(Request $request, $compte)
    {
        $request->validate([
            'montantDepot' => 'required|numeric|gt:0',
        ]);



        $cpt = Compte::find($compte);
        $balance = $cpt->balance;

        $ceMois = Carbon::now()->month;
        $somme = Transaction::where('id_compte_destinataire', $cpt->id)->where('id_type', 2)->whereMonth('created_at', $ceMois)->sum('montant');

        $montantDepot = $request->input('montantDepot');
        $plafond = $cpt->pack->plafond;

        if ($plafond != 0) { //sa veut dire que le compte n'est pas illimite

            if ($montantDepot > $plafond) {

                return redirect()->back()->with('success', 'le montant a deposer depasse le plafond de ce compte');
            } elseif ($somme >= $plafond) {

                return redirect()->back()->with('success', 'Ce compte a atteint son plafond impossible d\'effectuer une autre transaction ');
            } elseif ($somme + $montantDepot > $plafond) {

                return redirect()->back()->with('success', 'impossible de deposer une telle somme car avec cette somme le plafond sera depasser ');
            } else {

                $cpt->increment('balance', $montantDepot);
            }
        } else {
            $cpt->increment('balance', $montantDepot);
        }


        $codeTrans = $request->input('codeTransaction');
        $transaction = [
            'code' => $codeTrans,
            'id_compte_emetteur' => 1,
            'id_compte_destinataire' => $cpt->id,
            'id_emetteur' => 1,
            'id_destinataire' => $cpt->client->id,
            'montant' => $montantDepot,
            'id_type' => 2, //type retrait
        ];

        $t = Transaction::create($transaction);


        $input = [
            'prenom' => $cpt->client->prenom,
            'nom' => $cpt->client->nom,
            'code' => $codeTrans,
            'type' => 'Depot',
            'montant' => $montantDepot,
            'compte' => $cpt->numero,
            'Date' => $t->created_at,
            'email' => $cpt->client->email,
            'balance' => $cpt->balance,
        ];

        Mail::to($input['email'])->send(new MailTransaction($input));

        return redirect()->route('transactions.depotRetrait')->with('success', 'Depot Bien effectuer');
    }

    public function retrait($compte)
    {
        $cpt = Compte::find($compte);
        $codeTrans = Str::random(15) . $cpt->id;
        return view('Admin.retrait', compact('cpt', 'codeTrans'));
    }

    public function doRetrait(Request $request, $compte)
    {
        $request->validate([
            'montantRetrait' => 'required|numeric|gt:0',
        ]);


        $cpt = Compte::find($compte);
        $balance = $cpt->balance;

        $ceMois = Carbon::now()->month;
        $somme = Transaction::where('id_compte_destinataire', $cpt->id)->where('id_type', 3)->whereMonth('created_at', $ceMois)->sum('montant');

        $plafond = $cpt->pack->plafond;
        $montantRetrait = $request->input('montantRetrait');

        if ($plafond != 0) { //sa veut dire que le compte n'est pas illimite

            if ($montantRetrait > $balance) {

                return redirect()->back()->with('success', 'le montant a retirer depasse la balance du compte ');
            } elseif ($montantRetrait > $plafond) {

                return redirect()->back()->with('success', 'le montant a retirer depasse le plafond de ce compte');
            } elseif ($somme >= $plafond) {

                return redirect()->back()->with('success', 'Ce compte a atteint son plafond impossible d\'effectuer une autre transaction ');
            } elseif ($somme + $montantRetrait > $plafond) {

                return redirect()->back()->with('success', 'impossible de deposer une telle somme car avec cette somme le plafond sera depasser ');
            } else {

                $cpt->decrement('balance', $montantRetrait);
            }
        } else {
            $cpt->decrement('balance', $montantRetrait);
        }

        $codeTrans = $request->input('codeTransaction');

        $transaction = [
            'code' => $codeTrans,
            'id_compte_emetteur' => 1,
            'id_compte_destinataire' => $cpt->id,
            'id_emetteur' => 1,
            'id_destinataire' => $cpt->client->id,
            'montant' => $montantRetrait,
            'id_type' => 3, //type retrait
        ];

        $t = Transaction::create($transaction);


        $input = [
            'prenom' => $cpt->client->prenom,
            'nom' => $cpt->client->nom,
            'code' => $codeTrans,
            'type' => 'Retrait',
            'montant' => $montantRetrait,
            'compte' => $cpt->numero,
            'Date' => $t->created_at,
            'email' => $cpt->client->email,
            'balance' => $cpt->balance,
        ];

        Mail::to($input['email'])->send(new MailTransaction($input));

        return redirect()->route('transactions.depotRetrait')->with('success', 'Retrait Bien effectuer');
    }



    public function transfertUn()
    {
        $clients = Utilisateur::whereHas('comptes', function ($query) {
            $query->where('id_type', 1);
        })->where('id_profil', 3)->get();
        $etape = 1;

        return view('Admin.TransfertClient', compact('etape', 'clients'));
    }


    public function transfertDeux($client1)
    {
        // $clients = Utilisateur::whereDoesntHave('comptes', function ($query) {
        //     $query->where('id_type', 1);
        // })->where('id', '!=', $client1 )->where('id_profil', 3)->get();

        // $clients = Utilisateur::whereHas('comptes', function ($query) {
        //         $query->where('id_type', 1);
        //     })->where('id', '!=', $client1 )->where('id_profil', 3)->get();

        $clients = Utilisateur::where('id_profil', 3)->where('id', '!=', $client1)->get();

        $etape = 2;

        return view('Admin.TransfertClient', compact('etape', 'client1', 'clients'));
    }

    public function transfertTrois($clt1, $clt2)
    {
        $client1 = Utilisateur::find($clt1);
        $client2 = Utilisateur::find($clt2);
        $compte1 = Compte::where('id_type', 1)->where('id_client', $client1->id)->first();

        $compte2 = Compte::where('id_type', 1)->where('id_client', $client2->id)->first();

        $codeTrans = Str::random(15) . $client1->id . $client2->id;

        // enelevr le fait le clients peut etre un compte epargne aussi

        return view('Admin.Transfert', compact('codeTrans', 'client1', 'client2', 'compte1', 'compte2'));
    }

    public function doTransfert(Request $request, $clt1, $clt2, $cpt1, $cpt2)
    {

        $montantDepot = $request->input('montantDepot');
        $client1 = Utilisateur::find($clt1);
        $client2 = Utilisateur::find($clt2);
        $compte1 = Compte::find($cpt1);
        $compte2 = Compte::find($cpt2);
        $plafondClt2 = $compte2->pack->plafond;
        $plafondClt1 = $compte1->pack->plafond;


        $ceMois = Carbon::now()->month;
        $somme1 = Transaction::where('id_compte_destinataire', $compte1->id)->where('id_type', '!=', 4)->whereMonth('created_at', $ceMois)->sum('montant');

        $somme2 = Transaction::where('id_compte_destinataire', $compte2->id)->where('id_type', '!=', 4)->whereMonth('created_at', $ceMois)->sum('montant');


        if ($plafondClt1 != 0 || $plafondClt2 != 0) { //sa veut dire que le compte n'est pas illimite

            if ($compte1->balance < $montantDepot) {
                return redirect()->back()->with('success', 'Votre compte n\' a pas assez de balance pour effectuer ce transfert ');
            } elseif ($montantDepot > $plafondClt1 && $plafondClt1 != 0) {

                return redirect()->back()->with('success', 'impossible d\'effectuer la transaction car le montant depasse le plafond de votre compte  ');
            } elseif ($somme1 >= $plafondClt1 && $plafondClt1 != 0) {

                return redirect()->back()->with('success', 'votre compte  a atteint son plafond impossible d\'effectuer une autre transaction ');
            } elseif ($somme1 + $montantDepot > $plafondClt1 && $plafondClt1 != 0) {

                return redirect()->back()->with('success', 'impossible de faire une transaction avec une telle somme car avec cette somme le plafond de l\'emmeteur sera depasser ');
            } elseif ($montantDepot > $plafondClt2 && $plafondClt2 != 0) { //destinataire

                return redirect()->back()->with('success', 'impossible d\'effectuer la transaction car le montant depasse le plafond du compte destinataire  ');
            } elseif ($somme2 >= $plafondClt2 && $plafondClt2 != 0) {

                return redirect()->back()->with('success', 'le compte du destinataire  a atteint son plafond impossible d\'effectuer une autre transaction ');
            } elseif ($somme2 + $montantDepot > $plafondClt2 && $plafondClt2 != 0) {

                return redirect()->back()->with('success', 'impossible de faire une transaction avec une telle somme car avec cette somme le plafond du destintaire sera depasser ');
            } else {
                $compte2->increment('balance', $montantDepot);
                $compte1->decrement('balance', $montantDepot);
            }
        } else {
            $compte2->increment('balance', $montantDepot);
            $compte1->decrement('balance', $montantDepot);
        }


        $codeTrans = $request->input('codeTransaction');
        $transaction = [
            'code' => $codeTrans,
            'id_compte_emetteur' => $compte1->id,
            'id_compte_destinataire' => $compte2->id,
            'id_emetteur' => $client1->id,
            'id_destinataire' => $client2->id,
            'montant' => $montantDepot,
            'id_type' => 1, //type transfert
        ];

        $t = Transaction::create($transaction);


        $input1 = [
            'prenom' => $client1->prenom,
            'nom' => $client1->nom,
            'prenom2' => $client2->prenom,
            'nom2' => $client2->nom,
            'code' => $codeTrans,
            'type' => 'Transfert',
            'montant' => $montantDepot,
            'compte' => $compte1->numero,
            'compte2' => $compte1->numero,
            'Date' => $t->created_at,
            'email' => $client1->email,
            'balance' => $compte1->balance,
        ];

        $input2 = [
            'prenom' => $client2->prenom,
            'nom' => $client2->nom,
            'prenom2' => $client1->prenom,
            'nom2' => $client1->nom,
            'code' => $codeTrans,
            'type' => 'Transfert',
            'montant' => $montantDepot,
            'compte' => $compte1->numero,
            'compte2' => $compte1->numero,
            'Date' => $t->created_at,
            'email' => $client2->email,
            'balance' => $compte2->balance,
        ];

        Mail::to($input1['email'])->send(new MailTransactionE($input1));
        Mail::to($input2['email'])->send(new MailTransactionR($input2));

        return redirect()->route('transfert.etapeUn')->with('success', 'Transfert Bien effectuer');
    }

    public function rollback(string $id)
    {
        $transaction = Transaction::find($id);
        // $emetteur = Utilisateur::find($transaction->id_emetteur);
        // $destinataire = Utilisateur::find($transaction->id_destinataire);
        // $typeTransaction = TypeTransaction::find($transaction->id_type);
        // $compteDestinataire = Compte::find($transaction->id_compte_destinataire);
        //dd($transaction -> recepteur-> nom);

        if ($transaction->emetteur->id != 1) {

            //dd($transaction-> compte_recepteur -> client -> nom);


            $transaction->compte_recepteur->decrement('balance', $transaction->montant);
            $transaction->compte_emetteur->increment('balance', $transaction->montant);
            $input1 = [
                'pass' => 1,
                'prenom' => $transaction->recepteur->prenom,
                'nom' => $transaction->recepteur->nom,
                'autreClientPrenom' => $transaction->emetteur->prenom,
                'autreClientNom' => $transaction->emetteur->nom,
                'code' => $transaction->code,
                'type' => $transaction->type_transaction->libelle,
                'montant' => $transaction->montant,
                'compte' =>  $transaction->compte_recepteur->type->libelle,
                'Date' => (new DateTime())->format('Y-m-d H:i:s'),
                'balance' => $transaction->compte_recepteur->balance,
                'email' =>  $transaction->recepteur->email,
            ];

            $input2 = [
                'pass' => 2,
                'prenom' => $transaction->emetteur->prenom,
                'nom' => $transaction->emetteur->nom,
                'autreClientPrenom' => $transaction->recepteur->prenom,
                'autreClientNom' =>  $transaction->recepteur->prenom,
                'code' => $transaction->code,
                'type' => $transaction->type_transaction->libelle,
                'montant' => $transaction->montant,
                'compte' =>  $transaction->compte_emetteur->type->libelle,
                'Date' => (new DateTime())->format('Y-m-d H:i:s'),
                'balance' => $transaction->compte_emetteur->balance,
                'email' =>  $transaction->emetteur->email,
            ];

            Mail::to($input1['email'])->send(new mailRollbackClient($input1));
            Mail::to($input2['email'])->send(new mailRollbackClient($input2));

            $transaction->delete;
        } else {

            if ($transaction->type_transaction->id == 2) {
                //si on a fais un depot alors on retire le montant du compte sinon on remet le montant

                $transaction->compte_recepteur->decrement('balance', $transaction->montant);

                $input = [
                    'prenom' => $transaction->recepteur->prenom,
                    'nom' => $transaction->recepteur->nom,
                    'code' => $transaction->code,
                    'type' => $transaction->type_transaction->libelle,
                    'montant' => $transaction->montant,
                    'compte' =>  $transaction->compte_recepteur->type->libelle,
                    'Date' => (new DateTime())->format('Y-m-d H:i:s'),
                    'balance' => $transaction->compte_recepteur->balance,
                    'email' =>  $transaction->recepteur->email,
                ];



                Mail::to($input['email'])->send(new mailRollbackAgence($input));
                $transaction->delete;
            } else {

                $transaction->compte_emetteur->increment('balance', $transaction->montant);

                $input = [
                    'prenom' => $transaction->recepteur->prenom,
                    'nom' => $transaction->recepteur->nom,
                    'code' => $transaction->code,
                    'type' => $transaction->type_transaction->libelle,
                    'montant' => $transaction->montant,
                    'compte' =>  $transaction->compte_recepteur->type->libelle,
                    'Date' => (new DateTime())->format('Y-m-d H:i:s'),
                    'balance' => $transaction->compte_recepteur->balance,
                    'email' =>  $transaction->recepteur->email,
                ];



                Mail::to($input['email'])->send(new mailRollbackAgence($input));

                $transaction->delete;
            }
        }

        $transaction->delete(); //ensuite on supprime la transaction

        return redirect()->route('transactions.liste')->with('success', 'transaction annuler avec succès.');
    }

    public function agiosDecrement()
    {
        $comptes = Compte::Where('id', '!=', 1)->get();

        foreach ($comptes as $c) {

            $a = $c->pack->agios;

            $codeTrans = Str::random(15) . $c->id;

            $transaction = [
                'code' => $codeTrans,
                'id_compte_emetteur' => 1,
                'id_compte_destinataire' => $c->id,
                'id_emetteur' => 1,
                'id_destinataire' => $c->client->id,
                'montant' => $a,
                'id_type' => 4, //type Agio
            ];

            $c->decrement('balance', $a);

            $t = Transaction::create($transaction);

            $input = [
                'prenom' => $c->client->prenom,
                'nom' => $c->client->nom,
                'montant' => $a,
                'pack' => $c->pack->libelle,
                'compte' => $c->numero,
                'Date' => $t->created_at,
                'email' => $c->client->email,
                'balance' => $c->balance,
            ];

            Mail::to($input['email'])->send(new mailAgio($input));
        }

        return redirect()->route('admins.index')->with('success', 'Agio effectuer');
    }

    public function agiosIncrement()
    {
        $comptes = Compte::Where('id', '!=', 1)->get();
        $ceMois = Carbon::now()->month;

        foreach ($comptes as $c) {

            $a = $c->pack->agios;

            $c->increment('balance', $a);

            $trans = Transaction::where('id_compte_destinataire', $c->id)
                ->whereMonth('created_at', $ceMois)
                ->where('id_type', 4)
                ->first();

            if ($trans) {
                $trans->delete();
            }

            $input = [
                'prenom' => $c->client->prenom,
                'nom' => $c->client->nom,
                'montant' => $a,
                'pack' => $c->pack->libelle,
                'compte' => $c->numero,
                'Date' => (new DateTime())->format('Y-m-d H:i:s'),
                'email' => $c->client->email,
                'balance' => $c->balance,
            ];

            Mail::to($input['email'])->send(new mailExcuseAgio($input));
        }

        return redirect()->route('admins.index')->with('success', 'Rollback effectuer');
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
        $t = Transaction::find($id);
        $t->delete();
        return redirect()->route('transactions.liste')->with('success', 'transaction annuler avec succès.');
    }
}
