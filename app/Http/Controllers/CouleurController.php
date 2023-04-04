<?php

namespace App\Http\Controllers;

use App\Models\Couleur;
use Illuminate\Http\Request;

class CouleurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $couleurs = Couleur::all();

        return view("couleurs.index",compact("couleurs"));
    }

    public function saveCouleur(Request $request)
    {
        // get the form data
        $id = $request->input('id');
        $name = $request->input('name');
        
        // determine whether to create or update the record
        if ($id) {
            // update the existing record
            $couleur = Couleur::find($id);
            $couleur->name = $name;
            $couleur->save();

            return response()->json(['success' => true, 'message' => 'Couleur updated successfully']);
        } else {
            // create a new record
            $couleur = new Couleur();
            $couleur->name = $name;
            $couleur->save();

            return response()->json(['success' => true, 'message' => 'Couleur created successfully']);
        }
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
    public function show(Couleur $couleur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Couleur $couleur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Couleur $couleur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $couleur = Couleur::find($id);
        $couleur->delete();
        return  response()->json(['success' => true, 'message' => 'Couleur deleted successfully'], 200);
    }
}
