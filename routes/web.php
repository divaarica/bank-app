<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarteBancaireController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\GuichetierController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });




//Admin 
Route::get('admins/transactions/liste-transactions', [TransactionController::class, 'listeTransactions'])->name('transactions.liste');
Route::put('admins/transactions/agio', [TransactionController::class, 'agiosDecrement'])->name('transactions.agio');
Route::put('admins/transactions/erreur/agio', [TransactionController::class, 'agiosIncrement'])->name('transactions.erreurAgio');
Route::get('admins/liste-clients', [AdminController::class, 'listeClients'])->name('admins.clients');
Route::get('admins/liste-comptes', [AdminController::class, 'listeComptes'])->name('admins.comptes');
Route::get('admins/clients-create', [AdminController::class, 'createClient'])->name('admins.clientCreate');
Route::patch('admins/liste-clients/desactiver/client/{client}', [AdminController::class, 'desactiverClient'])->name('admins.desactiverClient');
Route::patch('admins/liste-clients/activer/client/{client}', [AdminController::class, 'activerClient'])->name('admins.activerClient');
Route::patch('admins/liste-clients/desactiver/compte/{compte}', [AdminController::class, 'desactiverCompte'])->name('admins.desactiverCompte');
Route::patch('admins/liste-clients/activer/compte/{compte}', [AdminController::class, 'activerCompte'])->name('admins.activerCompte');
Route::resource('admins', AdminController::class);




//Clients 
Route::get('clients/mes-transactions', [ClientController::class, 'mesTransactions'])->name('clients.mesTransactions');
Route::get('clients/edit', [ClientController::class, 'showc'])->name('clients.showw');
Route::get('clients/cartes', [ClientController::class, 'choixCarte'])->name('client.cartes');
Route::get('clients/cartes/{choix}', [CarteBancaireController::class, 'generer'])->name('client.genererCarte');
Route::put('clients/cartes/{choix}', [CarteBancaireController::class, 'validerCarte'])->name('client.validerCarte');
Route::get('clients/mesCartes', [CarteBancaireController::class, 'mesCartes'])->name('client.mesCartes');
Route::resource('clients', ClientController::class);


//Guichetier
Route::resource('guichetiers', GuichetierController::class);


//Comptes
Route::get('comptes/open-close', [CompteController::class, 'openClose'])->name('comptes.openClose');
Route::put('comptes/open/courant/{client}/{pack}', [CompteController::class, 'openCompteCourant'])->name('comptes.openCourant');
Route::put('comptes/open/epargne/{client}/{pack}', [CompteController::class, 'openCompteEpargne'])->name('comptes.openEpargne');
Route::resource('comptes', CompteController::class);


//Categorie categories.updatePack
Route::get('categories/packs', [CategorieController::class, 'listePacks'])->name('categories.packs');
Route::get('categories/types', [CategorieController::class, 'listeTypes'])->name('categories.types');

Route::put('categories/packs', [CategorieController::class, 'createPack'])->name('categories.createPack');
Route::put('categories/types', [CategorieController::class, 'createTypeCompte'])->name('categories.createTypeCompte');

Route::patch('categories/packs/{pack}', [CategorieController::class, 'updatePack'])->name('categories.updatePack');
Route::patch('categories/types/{type}', [CategorieController::class, 'updateTypeCompte'])->name('categories.updateTypeCompte');

Route::delete('categories/packs/{pack}', [CategorieController::class, 'destroyPack'])->name('categories.destroyPack');
Route::delete('categories/types/{type}', [CategorieController::class, 'destroyTypeCompte'])->name('categories.destroyTypeCompte');
Route::resource('categories', CategorieController::class);



//Transaction 

//transfert Client



Route::get('clients/compte/courant', [CompteController::class, 'compteCourant'])->name('client.compteCourant');

Route::get('clients/compte/epargne', [CompteController::class, 'compteEpargne'])->name('client.compteEpargne');

Route::get('clients/transaction/transfert/meme', [TransactionController::class, 'transfertMemeBanque'])->name('transactions.memeBanque');
Route::post('clients/transaction/transfert/meme', [TransactionController::class, 'ValidertransfertMemeBanque']);

Route::put('clients/transaction/transfert/meme/{clt1}/ {clt2}/ {cpt1}/ {cpt2}', [TransactionController::class, 'dotransfertClient'])->name('transactions.dotransfertClient');


Route::get('clients/transaction/transfert/differente', [TransactionController::class, 'transfertBanqueDifferente'])->name('transactions.banqueDifferente');

Route::put('clients/transaction/transfert/differente/do', [TransactionController::class, 'ValidertransfertBanqueDifferente'])->name('transactions.DobanqueDifferente');


Route::get('clients/transaction/transfert/epargne', [TransactionController::class, 'transfertCompteEpargne'])->name('transactions.compteEpargne');
Route::put('clients/transaction/transfert/epargne/{compteEpargne}/{compteCourant}', [TransactionController::class, 'doTransfertEpargne'])->name('transactions.doTransfertEpargne');

Route::get('clients/transaction/transfert', [TransactionController::class, 'transfertClient'])->name('transactions.transfertClient');

Route::get('clients/transaction/retrait', [TransactionController::class, 'retraitClient'])->name('transactions.retraitClient');

Route::get('clients/transaction/transfert/choix', [TransactionController::class, 'choixTransfert'])->name('transactions.choixTransfert');


//rollback
Route::delete('admins/transactions/rollback/{transaction}', [TransactionController::class, 'rollback'])->name('transactions.rollback');

//depot retrait
Route::get('admins/transactions/depot-retrait', [TransactionController::class, 'depotRetrait'])->name('transactions.depotRetrait');

//depot
Route::get('admins/transactions/depot/{compte}', [TransactionController::class, 'depot'])->name('transactions.depot');

Route::put('admins/transactions/depot/{compte}', [TransactionController::class, 'doDepot'])->name('transactions.doDepot');

//retrait
Route::get('admins/transactions/retrait/{compte}', [TransactionController::class, 'retrait'])->name('transactions.retrait');

Route::put('admins/transactions/retrait/{compte}', [TransactionController::class, 'doRetrait'])->name('transactions.doRetrait');


//transfert
Route::get('admins/transactions/transfert/1', [TransactionController::class, 'transfertUn'])->name('transfert.etapeUn');

Route::put('admins/transactions/transfert/{clt1}/{clt2}/{cpt1}/{cpt2}', [TransactionController::class, 'doTransfert'])->name('transfert.doTransfert');

Route::get('admins/transactions/transfert/2/{client1}', [TransactionController::class, 'transfertDeux'])->name('transfert.etapeDeux');
Route::get('admins/transactions/transfert/3/{client1}/{client2}/', [TransactionController::class, 'transfertTrois'])->name('transfert.etapeTrois');

Route::put('admins/transactions/recevoirInfo', [TransactionController::class, 'receVoirInfo'])->name('transactions.receVoirInfo');


Route::resource('transactions', TransactionController::class);

//carte
Route::resource('cartes', CarteBancaireController::class);


//Login
//par convention on appelle se chemin auth.login
Route::get('/login',[AuthController::class,'loginForm'])->name('auth.login');
Route::post('/login',[AuthController::class,'login']);

Route::get('/validerPassword',[AuthController::class,'validerPasswordForm'])->name('auth.validerPasswordForm');
Route::post('/validerPassword/{id}/valider',[AuthController::class,'validerPassword'])->name('auth.validerPassword');;

Route::get('/forgotPassword',[AuthController::class,'forgotPasswordForm'])->name('auth.forgotPasswordForm');
Route::put('/forgotPassword/valider',[AuthController::class,'forgotPassword'])->name('auth.forgotPasswordValider');

Route::delete('/logout',[AuthController::class,'logout'])->name('auth.logout');


Route::get('/acceuil', [AccueilController::class, 'index'])->name('accueil.index');


//Route::get('/send-mail', Mon)
// Route::get('/', [AdminController::class, 'index']);

Route::get('/', [AccueilController::class, 'index']);
