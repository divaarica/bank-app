<?php

namespace App\Http\Controllers;

use App\Models\Packs;
use App\Models\TypeCompte;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.listeCategorie');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    public function createTypeCompte(Request $request)
    {
        $request->validate(
            [
                "libelle" => "required",
            ]
        );

        TypeCompte::create($request->all());

        return redirect()->route('categories.types')->with('success', 'Type de compte ajouter avec succès.');
        
    }

    public function createPack(Request $request)
    {

        $request->validate(
            [
                "libelle" => "required",
                "agios" => "required",
                "plafond" => "required|numeric",
            ]
        );

        Packs::create($request->all());

        return redirect()->route('categories.packs')->with('success', 'Pack ajouter avec succès.');

    }

    public function updateTypeCompte(Request $request, $id)
    {
        $type = TypeCompte::find($id);
        $request->validate(
            [
                "libelle" => "required",
            ]
        );


        $input = $request->all(); 
        $type->update($input);

        return redirect()->route('categories.types')->with('success', 'Type ajouter avec succès.');


        
    }

    public function updatePack(Request $request, $id)
    {
        $pack = Packs::find($id);

        $request->validate(
            [
                "libelle" => "required",
                "agios" => "required",
                "plafond" => "required|numeric",
            ]
        );

        $input = $request->all(); 
        $pack->update($input);

        return redirect()->route('categories.packs')->with('success', 'Guichetier modifier avec succès.');
    }

    

    public function listepacks()
    {
        $packs = Packs::all();
        return view('Admin.listePack', compact('packs'));
    }

    public function listetypes()
    {
        $types = TypeCompte::all();
        return view('Admin.listeTypeCompte', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
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
        //
    }

    public function destroyPack(string $id)
    {
        $user = Packs::find($id);
        $user->delete();
        return redirect()->route('categories.packs')->with('success', 'Pack supprimer avec succès.');
    }

    public function destroyTypeCompte(string $id)
    {
        $user = TypeCompte::find($id);
        $user->delete();
        return redirect()->route('categories.types')->with('success', 'Type de compte supprimer avec succès.');
    }
}
