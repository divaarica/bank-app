<?php

namespace App\Http\Controllers;

use App\Mail\mailSimple;
use App\Mail\MonMail;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class GuichetierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = Utilisateur::where('id_profil', '!=', '1')->where('id_profil', '!=', 3)->get();
        return view('Admin.listeStaff', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.ajouterGuichetier');
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



        $password = Str::random(5);

        $str = Str::random(2);
        $input = array_merge([
            'numero' => 'Guichetier-' . $str . $request->input('numeroCI'),
            'password' => Hash::make($password),
            'id_profil' => 2,
            'authentification' => 0,
            'state' => 1,
        ], $request->all());


        $request['pass'] = $password;

        //dd($input);
        $u = Utilisateur::create($input);

        Mail::to($input['email'])->send(new mailSimple($request));
        //dd("ok");

        return redirect()->back()->with('flash_message', 'Guichetier creer avec succès.');
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
        $guichetier = Utilisateur::find($id);
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
        $guichetier->update($input);

        return redirect()->route('guichetiers.index')->with('success', 'Guichetier modifier avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Utilisateur::find($id);
        $user->delete();
        return redirect()->route('guichetiers.index')->with('success', 'Guichetier supprimer avec succès.');
    }
}
